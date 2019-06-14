<?php

namespace App\Http\Controllers;

use App\Report;
use App\AdminControlPanel;
use Illuminate\Http\Request;

class AdminControlPanelController extends Controller
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
    public function index(Report $report)
    {
        $this->authorize('view', $report);
        return view('acp.index');
    }

    public function indexUsers(Report $report)
    {
        $this->authorize('view', $report);
        return view('acp.users.index');
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
     * @param  \App\AdminControlPanel  $adminControlPanel
     * @return \Illuminate\Http\Response
     */
    public function show(AdminControlPanel $adminControlPanel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminControlPanel  $adminControlPanel
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminControlPanel $adminControlPanel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminControlPanel  $adminControlPanel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminControlPanel $adminControlPanel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminControlPanel  $adminControlPanel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminControlPanel $adminControlPanel)
    {
        //
    }
}
