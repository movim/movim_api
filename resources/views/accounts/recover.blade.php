@extends('layouts.movim', ['title' => 'Account Recovery'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <div>
                <p class="center">Account recovery</p>
                <p class="center">Recover my movim.eu and jappix.com accounts</p>
            </div>
        </li>
    </ul>
</header>

<div class="block container">
    @include('parts.errors')

    <ul class="list thick card shadow">
        <li class="block color cyan">
            <i class="material-symbols main">info</i>
            <span class="primary icon">
                <i class="material-symbols">info</i>
            </span>
            <div>
                <p></p>
                <p class="all">
                    This is an account recovery form. Go directly to <a href="https://mov.im/" target="_blank">mov.im</a> or <a href="{{ route('servers.index') }}">pick a Movim server</a> to authenticate with your current account.
                </p>
            </div>
        </li>
    </ul>

    <ul class="list middle">
        <li>
            <div>
                <p></p>
                <p class="all">Enter your Movim account to receive by email (if configured) and chat message a unique link to authenticate you and allow you to reset your password</p>
            </div>
        </li>
        <li>
            <span class="primary icon gray"><i class="material-symbols">security</i></span>
            <form method="POST" action="{{ route('accounts.requestAuthentication') }}" accept-charset="UTF-8">
                @csrf
                <div>
                    <label for="username">Movim account</label>
                    <input placeholder="username@movim.eu or @jappix.com" required="" name="username" type="text" id="username">
                </div>
                <input class="button color oppose" type="submit" value="Recover">
            </form>
        </li>
        <br />
        <hr />
        <br />
        <li class="clear">
            <span class="primary icon gray"><i class="material-symbols">person_add</i></span>
            <div>
                <p>No account yet?</p>
                <p><a href="{{ route('accounts.register') }}">Create one in a few clicks…</a></p>
            </div>
        </li>
    </ul>
</div>

@endsection
