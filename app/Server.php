<?php

namespace App;

use App\ServerPing;
use App\ServerVote;
use App\Events\ServerCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => ServerCreated::class,
    ];

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

    public function retrieveScores()
    {
        $votes = new ServerVote;
        $pings = new ServerPing;
        $voteCount = $votes->whereMonth('created_at', today()->format('m'))->pluck('server_id')->countBy();
        $pingTotalCount = $pings->pluck('server_id')->countBy();
        $pingOnlineCount = $pings->where('status', 1)->pluck('server_id')->countBy();

        $attributes = [
            'vote_count' => $voteCount,
            'ping_count' => [
                'total' => $pingTotalCount,
                'online' => $pingOnlineCount,
            ],
        ];

        return collect($attributes);
    }

    public function retrieveRanks()
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
