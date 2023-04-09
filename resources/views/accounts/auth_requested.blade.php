@extends('layouts.movim')

@section('content')

<header>
    <ul class="list middle">
        <li>
            <span onclick="window.history.back();" class="primary active icon gray">
                <i class="material-icons">chevron_left</i>
            </span>
            <div>
                <p class="center">Authentication request</p>
            </div>
        </li>
    </ul>
</header>

<div class="block container">
    <ul class="list thick">
        <li>
            <span class="primary icon bubble color green">
                <i class="material-icons">vpn_key</i>
            </span>
            <div>
                <p>Authentication request sent by message</p>
                <p>An authentication link was sent to your XMPP account,<br /> please open it to finish the authentication</p>
            </div>
        </li>

        @if ($email)
            <li>
                <span class="primary icon bubble color blue">
                    <i class="material-icons">email</i>
                </span>
                <div>
                    <p>…and also by email</p>
                    <p>We also found an attached email address to your account,<br /> the authentication link was also sent there (please check your SPAM messages)</p>
                </div>
            </li>
        @endif
    </ul>
</div>

@endsection
