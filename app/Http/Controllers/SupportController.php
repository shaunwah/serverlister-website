<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('support.index');
    }

    public function showPrivacyPolicy()
    {
        return view('support.privacy_policy');
    }

    public function showTermsOfService()
    {
        return view('support.terms_of_service');
    }

    public function showRules()
    {
        return view('support.rules');
    }
}
