@extends('layouts.app')
@section('title', __('text.support.headers.privacy_policy'))
@section('content')
<div class="container">
    <h1 class="font-weight-bold">{{ __('text.support.headers.privacy_policy') }}</h1>
    @if (app()->getLocale() != 'en')
        <p class="text-muted font-italic">Only available in English</p>
    @endif
    <p>
        Your privacy is important to us.
        It is Zodurus Labs' policy to respect your privacy regarding any information we may collect from you across <a href="{{ route('home') }}">our website</a> and other sites we own and operate.
    </p>

    <p>
        We only ask for personal information when we truly need it to provide a service to you.
        We collect it by fair and lawful means, with your knowledge and consent.
        We also let you know why we’re collecting it and how it will be used.
    </p>

    <p>
        We only retain collected information for as long as necessary to provide you with your requested service.
        What data we store, we’ll protect within commercially acceptable means to prevent loss and theft,
        as well as unauthorised access, disclosure, copying, use or modification.
    </p>

    <p>
        We don’t share any personally identifying information publicly or with third-parties,
        except when required to by law.
    </p>

    <p>
        Our website may link to external sites that are not operated by us.
        Please be aware that we have no control over the content and practices of these sites,
        and cannot accept responsibility or liability for their respective privacy policies.
    </p>

    <p>
        You are free to refuse our request for your personal information,
        with the understanding that we may be unable to provide you with some of your desired services.
    </p>

    <p>
        Your continued use of our website will be regarded as acceptance of our practices around privacy and personal information.
        If you have any questions about how we handle user data and personal information, feel free to contact us through our <a href="{{ url('//discordapp.com/invite/nzqRgUw') }}" target="_blank">Discord server</a>.
    </p>

    <span class="text-muted">
        Effective as at 1 June 2019
    </span>
</div>
@endsection
