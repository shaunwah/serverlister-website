@extends('layouts.app')
@section('title', __('components.headers.support'))
@section('content')
<div class="container">
    <h1 class="font-weight-bold">{{ __('components.headers.support') }}</h1>
    <h3>What is ServerLister?</h3>
    <p>
        ServerLister is a Minecraft server list made to help you find the best Minecraft servers in the wild. We make use of multiple
        factors to help you find a quality server, including having a server scoring system that determines a server's quality.
    </p>

    <h3>What is this server scoring system?</h3>
    <p>
        The server scoring system takes into account its uptime, player count, vote count, and other server trend datasets and churns out a number based on an algorithm.
        The higher the score, the higher the determined quality of a server. This algorithm is calibrated regularly to help accurately identify quality servers.
    </p>

    <h3>What are votes?</h3>
    <p>
        Votes help indicate a server's popularity. The higher the votes a server has, the more popular a server is. Some servers have a voting rewards system in place,
        granting you a reward in return for voting for the server.
    </p>
    <p>
        If a server has a voting rewards system in place, it will usually be indicated in the server's vote page with text displaying <span class="font-italic">"You may receive a reward for voting."</span> to
        let you know that you may receive a reward upon voting. You may have to log in to the server for the first time to receive it.
    </p>

    <h3>How do I list my server?</h3>
    <p>
        You can create a server by navigating to the <a href="{{ route('servers.index') }}">servers page</a> after <a href="{{ route('register') }}">creating a ServerLister account</a>. The creation process
        takes less than five minutes so you can have your server listing up in no time!
    </p>
    <p>
        Our system only supports NuVotifier version 2 tokens. Your tokens are encrypted using OpenSSL (AES-256) and stored securely in our databases.
    </p>

    <h3>What if my server has already been listed?</h3>
    <p>
        ServerLister occasionally lists noteworthy servers from other Minecraft server lists on its website. You may request for a server takeover through
        our <a href="{{ url('//discordapp.com/invite/nzqRgUw') }}" target="_blank">Discord server</a>. We are working on an automated server takeover system at the moment
        through MOTD verification.
    </p>

    <h3>Where can I provide feedback?</h3>
    <p>
        We are currently in development and would love to hear from you. You may provide your valuable feedback through our <a href="{{ url('//discordapp.com/invite/nzqRgUw') }}" target="_blank">Discord server</a>.
    </p>
</div>
@endsection
