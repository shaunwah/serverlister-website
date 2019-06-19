<?php

namespace App\Http\Controllers;

use App\Server;
use App\Report;
use App\Utilities\GoogleReCaptcha;
use App\Http\Requests\StoreReport;
use Illuminate\Http\Request;

class ReportServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
    public function create(Server $server)
    {
        return view('servers.reports.create', compact('server'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReport $request, Server $server)
    {
        if (GoogleReCaptcha::validateResponse())
        {
            $validated = $request->validated();
            $validated['user_id'] = auth()->id();

            $report = new Report($validated);
            $server->reports()->save($report);

            session()->flash('alert_colour', 'success');
            session()->flash('alert', __('alerts.reports.create.success'));

            return redirect('/servers/' . $server->id);
        }
        session()->flash('alert_colour', 'danger');
        session()->flash('alert', __('alerts.services.recaptcha.failure'));
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
