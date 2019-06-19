<?php

namespace App;

use App\Reports;
use App\ServerPing;
use App\ServerVote;
use App\Events\ServerCreated;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

    public function retrieveScores() // to get
    {
        $votes = new ServerVote;
        $pings = new ServerPing;
        $voteCount = $votes->whereMonth('created_at', today()->format('m'))->pluck('server_id')->countBy();
        $pingTotalCount = $pings->pluck('server_id')->countBy();
        $pingOnlineCount = $pings->where('status', 1)->pluck('server_id')->countBy();
        $playersCurrentCount = $pings->pluck('players_current', 'server_id');

        $attributes = [
            'vote_count' => $voteCount,
            'ping_count' => [
                'total' => $pingTotalCount,
                'online' => $pingOnlineCount,
            ],
            'player_count' => $playersCurrentCount,
        ];

        return collect($attributes);
    }

    public function retrieveRanks() // to get
    {
        DB::statement(DB::raw('set @rank = 0'));

        return $query = $this->selectRaw('id, @rank := @rank + 1 as rank')->orderBy('score', 'desc')->get();
    }

    public function checkIfServerMotdMatches()
    {
        $ping = new ServerPing;
        $phrase = hash('sha256', $this->id . '-' . $this->host . ':' . $this->port);
        $data = $ping->queryServer($this->host, $this->port);

        if (@$data['description']['text'] != $phrase)
        {
            return false;
        }
        return true;
    }

    public function checkIfVotedToday()
    {
        $votes = new ServerVote;
        $result = $votes->where('server_id', $this->id)
                ->whereDate('created_at', today()->format('Y-m-d'))
                ->where(function ($query) {
                    $query->orWhere('username', request()->user)
                    ->orWhere('ip_address', request()->ip());
                });

        return $result->doesntExist();
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

    public function getDiff()
    {
        $changed = $this->getDirty();

        $before = json_encode(array_intersect_key($this->fresh()->toArray(), $changed));
        $after = json_encode($changed);

        return compact(['before', 'after']);
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
