<?php

namespace App;

use App\Minecraft\Query\MinecraftPing;
use App\Minecraft\Query\MinecraftPingException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ServerPing extends Model
{
    protected $guarded = [];

    public function pingServer(Server $server)
    {
        try
        {
            $ping = new MinecraftPing($server->host, $server->port);
            $response = $ping->query();
        }
        catch (MinecraftPingException $e)
        {
            report($e);
            return false;
        }
        finally
        {
            if (!isset($ping))
            {
                return false;
            }

            $ping->close();

            if ($response == null)
            {
                $data = [
                    'rank' => $server->rank,
                    'score' => $server->score,
                    'status' => false,
                ];

                $server->addPing($data);
                return false;
            }

            $data = [
                'rank' => $server->rank,
                'score' => $server->score,
                'status' => true,
                'protocol' => $response['version']['protocol'],
                'players_total' => $response['players']['max'],
                'players_current' => $response['players']['online'],
            ];

            $server->addPing($data);

            // Fetch and update favicon
            if (Arr::has($response, ['favicon']))
            {
                $favicon = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $response['favicon']));
                $path = 'servers/favicons/' . md5($server->id) . '.png';

                Storage::disk('local')->put('public/' . $path, $favicon);

                $server->update([
                    'favicon' => Storage::url($path),
                ]);
            }
            return true;
        }
    }

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
