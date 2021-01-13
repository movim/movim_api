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

<div class="top_padding">
    <ul class="list thick">
        <li>
            <span class="primary icon bubble color green">
                <i class="material-icons">vpn_key</i>
            </span>
            <div>
                <p>Authentication request sent</p>
                <p>An authentication link was sent to your XMPP account,<br /> please open it to finish the authentication</p>
            </div>
        </li>
    </ul>
</div>

@endsection
