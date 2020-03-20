@extends('layouts.movim')

@section('content')

<header>
    <ul class="list middle">
        <li>
            <span onclick="window.history.back();" class="primary active control icon gray">
                <i class="material-icons">chevron_left</i>
            </span>
            <p class="center">Authentication request</p>
        </li>
    </ul>
</header>

<div class="top_padding">
    <ul class="list thick">
        <li>
            <span class="primary icon bubble color green">
                <i class="material-icons">vpn_key</i>
            </span>
            <p>Authentication request sent</p>
            <p>An authentication link was sent to your XMPP account,<br /> please open it to finish the authentication</p>
        </li>
    </ul>
</div>

@endsection
