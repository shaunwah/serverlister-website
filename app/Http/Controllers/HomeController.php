<?php

namespace App\Http\Controllers;

use App\Report;
use App\Server;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('indexLoggedIn');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexLoggedIn()
    {
        $reports = Report::all();
        $servers = Server::where('user_id', auth()->id())->orderBy('rank', 'asc')->paginate(5);
        return view('dashboard', compact(['reports', 'servers']));
    }

    public function index()
    {
        $servers = Server::all();
        return view('home', compact('servers'));
    }
}
