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
                    This is an account recovery form. Go directly to <a href="https://mov.im/" target="_blank">mov.im</a> or <a href="{$c->route('server.index')}">pick a Movim server</a> to authenticate with your current account.
                </p>
            </div>
        </li>
    </ul>

    <ul class="list middle">
        <li>
            <div>
                <p class="normal all">Enter your Movim account to receive by email (if configured) and chat message a unique link to authenticate you and allow you to reset your password</p>
            </div>
        </li>
        <li>
            <span class="primary icon gray"><i class="material-symbols">security</i></span>
            {{ Form::open(['method' => 'POST', 'action' => ['AccountsController@requestAuthentication'], 'style' => 'padding-right: 0;']) }}

                <div>
                    {{ Form::label('username', 'Movim account') }}
                    {{ Form::text('username', null, ['placeholder' => 'username@movim.eu or @jappix.com', 'required']) }}
                </div>

            {{ Form::submit('Recover', ['class' => 'button color oppose', 'style' => 'margin-top: 0; margin: 0 auto;'])}}
            {{ Form::close() }}
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
