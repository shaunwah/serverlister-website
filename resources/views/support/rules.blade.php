@extends('layouts.app')
@section('title', __('Rules'))
@section('content')
<div class="container">
    <h1 class="font-weight-bold">Rules</h1>

    <p>
        In addition to the <a href="{{ url('/support/terms-of-service') }}">Terms of Service</a> laid down by <a href="{{ route('home') }}">ServerLister</a>, your access to this website is governed by the rules as stated in the preceding paragraphs. Non-compliance may restrict your access to this website and its services.
    </p>

    <h2>1. Listing servers on our website</h2>

    <p>
        Any user may list their server on our website, provided that it adheres to the following regulations:
        <ol type="a">
            <li>The server may not be running offline or requires a VPN to connect.</li>
            <li>The server may not be promoting illegal content, including drug abuse and pornography.</li>
            <li>The server may not be listed more than once.</li>
            <li>The server may not be part of a hub. Only the main node of a hub may be listed.</li>
            <li>The server may infringe the Minecraft End User Licensing Agreement (EULA).</li>
            <li>The server may infringe copyrights held by Microsoft Corporation and of its affiliates.</li>
            <li>The server may infringe laws in the Republic of Singapore.</li>
        </ol>
    </p>

    <h2>2. Voting for servers on our website</h2>

    <p>
        Any user may vote for a server on our website with compliance to the following regulations:
        <ol type="a">
            <li>The user may not be using a script or any botting-related software to vote for a server.</li>
            <li>The user may not be behind a VPN, a proxy, or any other software that modifies IP addresses to vote for a server.</li>
        </ol>
    </p>

</div>
@endsection
