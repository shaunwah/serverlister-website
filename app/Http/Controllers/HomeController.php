<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth')->only('indexDashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexDashboard()
    {
        $servers = Server::where('user_id', auth()->id())->orderBy('rank', 'asc')->paginate(5);
        return view('user.dashboard', compact('servers'));
    }

    public function index()
    {
        $servers = Server::all();
        return view('home', compact('servers'));
    }
}
