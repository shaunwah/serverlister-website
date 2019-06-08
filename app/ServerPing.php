<?php

namespace App;

use App\Minecraft\Query\MinecraftPing;
use App\Minecraft\Query\MinecraftPingException;
use Illuminate\Database\Eloquent\Model;

class ServerPing extends Model
{
    protected $guarded = [];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function queryServer($host, $port) // To be set to protected
    {
        try
        {
            $ping = new MinecraftPing($host, $port);
            return $ping->query();
        }
        catch (MinecraftPingException $e)
        {
            report($e);
            return false;
        }
        finally
        {
            if (isset($ping))
            {
                $ping->close();
            }
        }
    }

    public function pingServer(Server $server) //!!!
    {
        // $arr = new Arr;
        $data = $this->queryServer($server->host, $server->port);

        // if ($arr->exists($data['description'], 'extra'))
        // {
        //     $array = $data['description']['extra'];
        // }
        // else
        // {
        //     $pingDescrption = $data['description']['text'];
        // }

        $attributes = [
            'server_id' => $server->id,
            'rank' => $server->rank,
            'score' => $server->score,
            'status' => isset($data['version']['protocol']),
            'favicon' => (isset($data['favicon']) ? $data['favicon'] : null),
            'protocol' => $data['version']['protocol'],
            'description' => null, //!!!
            'players_total' => $data['players']['max'],
            'players_current' => $data['players']['online'],
        ];
        $server->addPing($attributes);
    }
}
