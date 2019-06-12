<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->morphedByMany('App\User', 'reportable');
    }

    public function servers()
    {
        return $this->morphedByMany('App\Server', 'reportable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
