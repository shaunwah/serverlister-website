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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->morphToMany('App\Report', 'reportable');
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

    public function getPlayerStatistics()
    {
        $players = $this->pings->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('d');
        });

        $players = $players->map(function ($item) {
            return round($item->avg('players_current'));
        });

        $dateData = collect();
        $playerData = collect();
        for ($i = 1; $i <= 10; $i++)
        {
            // $dateData->prepend(Carbon::now()->subDays($i)->format('j M Y'));
            $dateData->prepend(Carbon::now()->subDays($i)->format('j M'));
            $playerData->prepend(isset($players[Carbon::now()->subDays($i)->format('d')]) ? $players[Carbon::now()->subDays($i)->format('d')] : 0);
        }

        return ['dates' => $dateData, 'players' => $playerData];
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
}
