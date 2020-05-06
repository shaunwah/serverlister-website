<?php

namespace App;

use App\Reports;
use App\ServerPing;
use App\ServerVote;
use App\Minecraft\Query\MinecraftPing;
use App\Minecraft\Query\MinecraftPingException;
use App\Events\ServerCreated;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => ServerCreated::class,
    ];

    public function getStatistics($days = 7)
    {
        $dates = $this->getDateLabels($days);
        $players = $this->getPlayerStatistics($days);
        $votes = $this->getVoteStatistics($days);

        return compact('dates', 'players', 'votes');
    }

    protected function getDateLabels($days = 7)
    {
        $dateLabels = array();
        for ($i = ($days - 1); $i >= 0; $i--)
        {
            $dateLabels[] = now()->subDays($i + 1)->isoFormat('Do');
        }
        return $dateLabels;
    }

    protected function getPlayerStatistics($days = 7)
    {
        $pings = $this->pings->sortBy('created_at')->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('d');
        });

        $playersMax = $pings->map(function ($item) {
            return $item->max('players_current');
        });

        $playersAvg = $pings->map(function ($item) {
            return round($item->avg('players_current'));
        });

        $playersMaxData = array();
        $playersAvgData = array();
        for ($i = now()->subDays($days)->format('d'); $i <= now()->yesterday()->format('d'); $i++)
        {
            $playersMaxData[] = @(int)$playersMax[$i];
            $playersAvgData[] = @(int)$playersAvg[$i];
        }

        return compact('playersMaxData', 'playersAvgData');
    }

    protected function getVoteStatistics($days = 7)
    {
        $votes = $this->votes->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('d');
        });

        $votes = $votes->map(function ($item) {
            return $item->count();
        });

        $votesData = array();
        for ($i = now()->subDays($days)->format('d'); $i <= now()->yesterday()->format('d'); $i++)
        {
            $votesData[] = @(int)$votes[$i];
        }

        return $votesData;
    }

    public function getAllStatistics()
    {
        $servers = Server::all();

        $data = $servers->mapWithKeys(function ($server) {
            return [
                $server->id => [
                    'players_current' => $server->pings->last()->players_current,
                    'votes' => $server->votes->whereBetween('created_at', [today()->subMonths(1), now()])->count(),
                    'pings' => [
                        'total' => $server->pings->count(),
                        'successful' => $server->pings->where('status', true)->count(),
                    ],
                ],
            ];
        });

        return $data;
    }

    public function calculateAllScores($data)
    {
        $attributes = $data->mapWithKeys(function ($item, $serverId) {
            return [
                $serverId => [
                    'players' => [
                        'weight' => 0.0025,
                        'value' => $item['players_current'],
                    ],
                    'votes' => [
                        'weight' => 3,
                        'value' => $item['votes'],
                    ],
                    'uptime' => [
                        'weight' => 0.75,
                        'value' => ($item['pings']['total'] == 0 ? 0 : $item['pings']['successful']/$item['pings']['total']),
                    ],
                ],
            ];
        });

        $scores = $attributes->mapWithKeys(function ($item, $serverId) {
            return [
                $serverId => 5/7 * ($item['players']['weight'] * $item['players']['value']) + ($item['votes']['weight'] * $item['votes']['value']) + ($item['uptime']['weight'] * $item['uptime']['value']) / 3,
            ];
        });

        return $scores;
    }

    public function calculateAllRanks($scores)
    {
        $data = $scores->sort()->reverse();

        $i = 1;
        $ranks = array();
        foreach ($data as $serverId => $val)
        {
            $ranks[$serverId] = $i++;
        }

        return $ranks;
    }

    public function checkIfServerMotdMatches()
    {
        $ping = new MinecraftPing($this->host, $this->port);
        $phrase = hash('sha256', $this->id . '-' . $this->host . ':' . $this->port);
        $ping->connect();
        $data = $ping->query();

        if (@$data['description']['text'] != $phrase)
        {
            return false;
        }
        return true;
    }

    public function hasUserVotedToday()
    {
        $votes = new ServerVote;
        $result = $votes->where('server_id', $this->id)
            ->whereDate('created_at', today()->format('Y-m-d'))
            ->where(function ($query) {
                $query->orWhere('username', request()->username)
                ->orWhere('ip_address', request()->ip());
            });

        return $result->exists();
    }

    public function getDiff()
    {
        $changed = $this->getDirty();

        $before = json_encode(array_intersect_key($this->fresh()->toArray(), $changed));
        $after = json_encode($changed);

        return compact(['before', 'after']);
    }

    public function sendDiscordNotification()
    {
        $username = isset(request()->username) ? request()->username : 'someone';

        $payload = [
            'content' => "{$this->name} has received a vote from {$username}.",
            'username' => 'serverlister.io',
            'embeds' => [
                [
                    'title' => "Vote for {$this->name}",
                    'description' => "Support {$this->name} by voting daily.",
                    'url' => route('servers.votes.create', $this->id),
                    'color' => '31743',
                    'thumbnail' => [
                        'url' => asset($this->favicon),
                    ],
                    'fields' => [
                        [
                            'name' => 'Today\'s Votes',
                            'value' => number_format($this->votes->whereBetween('created_at', [today(), now()])->count()),
                        ],
                        [
                            'name' => 'Month\'s Votes',
                            'value' => number_format($this->votes->whereBetween('created_at', [today()->subMonths(1), now()])->count()),
                        ],
                    ],
                ],
            ],
        ];

        $client = new Client();
        $clientHandler = $client->getConfig('handler');
        $tapMiddleware = Middleware::tap(function ($request){
            $request->getHeaderLine('Content-Type');
            $request->getBody();
        });

        $response = $client->request('POST', 'https://discordapp.com/api/webhooks/591625142203973642/cZ1L31E8NBZWVlp79pNUuTA-48yOMRT2r1Q1mj7LzqYfr4c10QPgED-qpD3glE_2VW8v', [
            'json' => $payload,
            'handler' => $tapMiddleware($clientHandler),
        ]);

        if ($response)
        {
            return true;
        }
        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->morphToMany('App\Report', 'reportable');
    }

    public function verifications()
    {
        return $this->belongsToMany('App\User', 'server_verifications')
            ->withPivot(['before', 'after'])
            ->withTimeStamps();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    public function type()
    {
        return $this->belongsTo(ServerType::class);
    }

    public function pings()
    {
        return $this->hasMany(ServerPing::class);
    }

    public function votes()
    {
        return $this->hasMany(ServerVote::class);
    }

    public function addPing($ping)
    {
        $this->pings()->create($ping);
    }

    public function addVote($vote)
    {
        $this->votes()->create($vote);
    }
}
