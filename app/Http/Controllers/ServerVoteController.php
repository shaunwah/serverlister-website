<?php

namespace App\Http\Controllers;

use App\Server;
use App\ServerVote;
use App\Http\Requests\StoreServerVote;
use App\Utilities\GoogleReCaptcha;
use Illuminate\Http\Request;

class ServerVoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('store', 'update');
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
    public function create(Server $server, ServerVote $vote)
    {
        return view('servers.votes.create', compact(['server', 'vote']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServerVote $request, Server $server, ServerVote $vote)
    {
        if (GoogleReCaptcha::validateResponse())
        {
            if ($server->checkIfVotedToday())
            {
                $validated = $request->validated();
                $validated['user_id'] = auth()->id();
                $validated['ip_address'] = request()->ip();
                $server->addVote($validated);

                session()->flash('alert_colour', 'success');
                session()->flash('alert', __('servers.text.alerts.votes.create_success'));
            }
            else
            {
                session()->flash('alert_colour', 'danger');
                session()->flash('alert', __('servers.text.alerts.votes.create_failure'));
            }

            return redirect('/servers/' . $server->id);
        }
        else
        {
            session()->flash('alert_colour', 'danger');
            session()->flash('alert', 'Your device failed reCAPTCHA validation. Please try again.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServerVote  $serverVote
     * @return \Illuminate\Http\Response
     */
    public function show(ServerVote $serverVote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServerVote  $serverVote
     * @return \Illuminate\Http\Response
     */
    public function edit(ServerVote $serverVote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServerVote  $serverVote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServerVote $serverVote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServerVote  $serverVote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServerVote $serverVote)
    {
        //
    }
}
