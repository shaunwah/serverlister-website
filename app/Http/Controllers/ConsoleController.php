<?php

namespace App\Http\Controllers;

use App\User;
use App\Server;
use App\Report;
use App\Reportable;
use App\Console;
use Illuminate\Http\Request;

class ConsoleController extends Controller
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
    public function index(Console $console)
    {
        $this->authorize('view', $console);

        $users = User::all();
        $servers = Server::all();
        $reports = Report::all();

        return view('console.dashboard', compact(['users', 'servers', 'reports']));
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
     * @param  \App\Console  $console
     * @return \Illuminate\Http\Response
     */
    public function show(Console $console)
    {
        //
    }

    public function showReport(Console $console, Report $report)
    {
        $this->authorize('view', $console);
        $reportable = Reportable::where('report_id', $report->id)->first();
        if ($reportable->reportable_type == "App\Server")
        {
            $entity = Server::find($reportable->reportable_id);
        }
        elseif ($reportable->reportable_type == "App\User")
        {
            $entity = User::find($reportable->reportable_id);
        }

        return view('console.reports.show', compact('report', 'entity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Console  $console
     * @return \Illuminate\Http\Response
     */
    public function edit(Console $console)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Console  $console
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Console $console)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Console  $console
     * @return \Illuminate\Http\Response
     */
    public function destroy(Console $console)
    {
        //
    }
}
