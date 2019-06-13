<?php

namespace App\Http\Controllers;

use App\Server;
use App\ServerType;
use Illuminate\Http\Request;

class ServerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Server $server, ServerType $type)
    {
        $filtered = $type;
        $filters = ServerType::orderBy('name', 'asc')->get();
        $servers = $server->where('type_id', $type->id)->orderBy('rank', 'asc')->paginate(25);
        return view('servers.index', compact(['servers', 'filtered', 'filters']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServerType  $serverType
     * @return \Illuminate\Http\Response
     */
    public function show(ServerType $serverType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServerType  $serverType
     * @return \Illuminate\Http\Response
     */
    public function edit(ServerType $serverType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServerType  $serverType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServerType $serverType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServerType  $serverType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServerType $serverType)
    {
        //
    }
}
