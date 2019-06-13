<?php

namespace App\Http\Controllers;

use App\Country;
use App\Version;
use App\ServerType;
use App\Server;
use App\ServerVote;
use App\Http\Requests\StoreServer;
use App\Http\Requests\UpdateServer;
use Illuminate\Support\Str;
use Parsedown;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('throttle:3,1')->only('store', 'update');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Server $server)
    {
        $servers = Server::orderBy('rank', 'asc')->paginate(25);
        return view('servers.index', compact('servers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderBy('name', 'asc')->get();
        $versions = Version::orderBy('id', 'desc')->get();
        $types = ServerType::orderBy('name', 'asc')->get();
        return view('servers.create', compact(['countries', 'versions', 'types']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServer $request, Server $server)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug(request()->name) . '-' . mt_rand(0, 999999999);
        $validated['description'] = strip_tags($validated['description']); //!!!
        $validated['host'] = strtolower($validated['host']); //!!!
        $validated['rank'] = $server->count() + 1;
        $validated['voting_service_enabled'] = request()->has('voting_service_enabled');
        $validated['voting_service_host'] = strtolower($validated['voting_service_host']); //!!!
        $validated['voting_service_token'] = encrypt($validated['voting_service_token']);
        $server->create($validated);

        session()->flash('alert_colour', 'success');
        session()->flash('alert', request()->name . ' has been successfully added to ServerLister.');

        return redirect('/servers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server, ServerVote $vote)
    {
        $parsedown = new Parsedown;
        $parsedown->setSafeMode(true);
        $voteCountThisMonth = $vote->where('server_id', $server->id)->whereMonth('created_at', today()->format('m'))->count();
        $datesPlayers = $server->pings->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('DDD');
        });

        $playerDataLabels = $datesPlayers->map(function ($date) {
            return Carbon::parse($date->first()->created_at)->isoFormat('D MMM G');
        })->values()->take(10)->toJson();

        $playerData = $datesPlayers->map(function ($date) {
            return round($date->max('players_current'));
        })->values()->take(10)->toJson();


        return view('servers.show', compact('server', 'parsedown', 'voteCountThisMonth', 'playerDataLabels', 'playerData'));
    }

    public function showPanel(Server $server)
    {
        $this->authorize('update', $server);
        return view('servers.show_panel', compact('server'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        $this->authorize('update', $server);
        $countries = Country::orderBy('name', 'asc')->get();
        $versions = Version::orderBy('id', 'desc')->get();
        $types = ServerType::orderBy('name', 'asc')->get();
        return view('servers.edit', compact(['server', 'countries', 'versions', 'types']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServer $request, Server $server)
    {
        $this->authorize('update', $server);
        $validated = $request->validated();

        $validated['description'] = strip_tags($validated['description']); //!!!
        $validated['host'] = strtolower($validated['host']); //!!!
        $validated['voting_service_enabled'] = request()->has('voting_service_enabled');
        $validated['voting_service_host'] = strtolower($validated['voting_service_host']); //!!!
        $validated['voting_service_token'] = encrypt($validated['voting_service_token']);

        session()->flash('alert_colour', 'success');
        session()->flash('alert', 'The server has been successfully updated.');

        $server->update($validated);

        return redirect('/servers/' . $server->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        $this->authorize('delete', $server);
        session()->flash('alert_colour', 'success');
        session()->flash('alert', 'The server has been successfully deleted.');

        return redirect('/servers');
    }
}
