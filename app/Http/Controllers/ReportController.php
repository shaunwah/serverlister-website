<?php

namespace App\Http\Controllers;

use App\User;
use App\Server;
use App\Report;
use App\Reportable;
use App\Utilities\GoogleReCaptcha;
use App\Http\Requests\StoreReport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ReportController extends Controller
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
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReport $request, Report $report)
    {
        if (GoogleReCaptcha::validateResponse())
        {
            $validated = $request->validated();
            $validated['user_id'] = auth()->id();

            if (request()->entity == 'server') // To clean up
            {
                $report = new Report($validated);
                $server = Server::findOrFail(request()->entity_id);
                $server->reports()->save($report);
            }
            elseif (request()->entity == 'user')
            {
                $report = new Report($validated);
                $server = User::findOrFail(request()->entity_id);
                $server->reports()->save($report);
            }
            else
            {
                session()->flash('alert_colour', 'warning');
                session()->flash('alert', 'You encounted an error while submitting a report.');

                return redirect('/dashboard');
            }

            session()->flash('alert_colour', 'success');
            session()->flash('alert', 'You have successfully submitted a report.');

            return redirect('/dashboard');
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
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
