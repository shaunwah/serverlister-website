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
        $this->middleware('auth')->only('indexLoggedIn');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexLoggedIn()
    {
        $servers = collect(auth()->user()->servers->all());
        return view('home', compact('servers'));
    }

    public function index()
    {
        $servers = Server::all();
        return view('index', compact('servers'));
    }
}
