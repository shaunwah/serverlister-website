<?php

namespace App;

use App\Minecraft\Query\MinecraftPing;
use App\Minecraft\Query\MinecraftPingException;
use Illuminate\Support\Facades\Storage;
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
        $data = $this->queryServer($server->host, $server->port);

        $attributes = [
            'rank' => $server->rank,
            'score' => $server->score,
            'status' => isset($data['version']['protocol']),
        ];

        if (isset($data))
        {
            $attributes['protocol'] = $data['version']['protocol'];
            $attributes['description'] = null; // To be implemented
            $attributes['players_total'] = $data['players']['max'];
            $attributes['players_current'] = $data['players']['online'];

            if (isset($data['favicon']))
            {
                $dataFavicon = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data['favicon']));
                $file = Storage::disk('local')->put('public/servers/favicons/' . md5($server->id) . '.png', $dataFavicon);
                $server->update(['favicon' => Storage::url('servers/favicons/' . md5($server->id) . '.png')]);
            }
        }

        $server->addPing($attributes);
    }
}
