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
        return view('home');
    }

    public function index()
    {
        $servers = Server::all();
        return view('index', compact('servers'));
    }
}
