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
            'server_id' => $server->id,
            'rank' => $server->rank,
            'score' => $server->score,
            'status' => isset($data['version']['protocol']),
            // 'favicon' => (isset($data['favicon']) ? $data['favicon'] : null),
            'protocol' => $data['version']['protocol'],
            'description' => null, //!!!
            'players_total' => $data['players']['max'],
            'players_current' => $data['players']['online'],
        ];
        $server->addPing($attributes);

        if (isset($data['favicon']))
        {
            $dataFavicon = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data['favicon']));
            $file = Storage::disk('local')->put('public/servers/favicons/' . md5($server->id) . '.png', $dataFavicon);
            $attributes = [
                'favicon' => Storage::url('servers/favicons/' . md5($server->id) . '.png'),
            ];
            $server->update($attributes);
        }
    }
}
