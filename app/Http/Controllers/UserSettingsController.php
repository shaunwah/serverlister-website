<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateUser($user)
    {
        return request()->validate([
            'username' => ['bail', 'required', 'string', 'min:3', 'max:24', Rule::unique('users')->ignore($user)],
            'email' => ['bail', 'required', 'string', 'email', 'min:3', 'max:255', Rule::unique('users')->ignore($user)],
        ]);
    }

    public function validateUser2($user)
    {
        return request()->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
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
    public function editAccount()
    {
        $user = auth()->user();
        return view('user.settings.account', compact('user'));
    }

    public function editSecurity()
    {
        $user = auth()->user();
        return view('user.settings.security', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request)
    {
        $user = auth()->user();
        $attributes = $this->validateUser($user);
        $user->update($attributes);

        session()->flash('alert_colour', 'success');
        session()->flash('alert', __('alerts.user.edit.success'));

        return back();
    }

    public function updateSecurity(Request $request)
    {
        $user = auth()->user();
        $attributes = $this->validateUser2($user);
        if (Hash::check($attributes['current_password'], $user->password))
        {
            $attributes['password'] = Hash::make($attributes['password']);
            $user->update($attributes);
            session()->flash('alert_colour', 'success');
            session()->flash('alert', __('alerts.user.edit.success'));
        }
        else
        {
            session()->flash('alert_colour', 'danger');
            session()->flash('alert', __('alerts.user.edit.failure'));
        }

        return back();
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
