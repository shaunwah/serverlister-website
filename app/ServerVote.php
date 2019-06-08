<?php

namespace App;

use App\Events\ServerVoteCreated;
use Illuminate\Database\Eloquent\Model;

class ServerVote extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => ServerVoteCreated::class,
    ];


    public function user()
    {
        return $this->belongsTo(Server::class);
    }

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
