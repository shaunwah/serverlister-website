<?php

namespace App\Http\Controllers;

use App\Server;
use App\ServerVerification;
use Illuminate\Http\Request;

class ServerVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:6,1')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Server $server, ServerVerification $verification)
    {
        $verificationPhrase = hash('sha256', $server->id . '-' . $server->host . ':' . $server->port);
        return view('servers.verifications.create', compact('server', 'verificationPhrase'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Server $server, ServerVerification $verification)
    {
        if ($server->checkIfServerMotdMatches() && (auth()->id() != $server->user_id))
        {
            $server->user_id = auth()->id();
            $server->verifications()->attach(auth()->id(), $server->getDiff());
            $server->save();

            session()->flash('alert_colour', 'success');
            session()->flash('alert', __('alerts.server_verifications.create.success'));

            return redirect('/servers/' . $server->id);
        }
        session()->flash('alert_colour', 'danger');
        session()->flash('alert', __('alerts.server_verifications.create.failure'));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
