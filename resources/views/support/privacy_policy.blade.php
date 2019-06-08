@extends('layouts.app')
@section('title', __('Support'))
@section('content')
<div class="container">
    <h1 class="font-weight-bold">Privacy Policy</h1>
    <h3>Who we are.</h3>
    <p>
        We are ServerLister, a Minecraft server list built and based in Singapore.
    </p>

    <h3>What personal data we collect.</h3>
    <ul>
        <li>
            When you create an account, we may collect your email address, and IP address.
        </li>
        <li>
            When you vote for a server, we may collect your IP address.
        </li>
    </ul>

    <h3>How we use your personal data.</h3>
    <ul>
        <li>
            Your personal data collected during account creation helps us to keep you updated through your email address on security updates and/or service notifications.
            Your IP address allows us to determine your approximate location to help calibrate your search results within the website.
        </li>
        <li>
            Your IP address collected during server voting helps us determine your location to determine a server's demographics.
        </li>
    </ul>
    <h3>Who do we share your data with.</h3>
    <p>
        We do not disclose your data to any third-parties.
    </p>
    <h3>Where can I provide feedback?</h3>
    <p>
        You may provide your valuable feedback through our <a href="{{ url('//discordapp.com/invite/nzqRgUw') }}" target="_blank">Discord server</a>.
    </p>
</div>
@endsection
