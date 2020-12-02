@extends('layouts.movim', ['title' => 'Account management'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <div>
                <p class="center">My Account</p>
                <p class="center">Manage my account settings and data</p>
            </div>
        </li>
    </ul>
</header>


<div class="flex">
    <div class="block on_desktop">
        <div class="placeholder">
            <i class="material-icons">vpn_key</i>
            <h4>Enter your Movim account to receive a chat message containing a unique link to authenticate you</h4>
        </div>
    </div>

    <div class="block top_padding">

        @include('parts.errors')

        <ul class="list thick divided" >
            <li>
                <span class="primary icon gray"><i class="material-icons">security</i></span>
                {{ Form::open(['method' => 'POST', 'action' => ['AccountsController@requestAuthentication'], 'style' => 'padding-right: 0;']) }}

                    <div>
                        {{ Form::label('username', 'Movim account') }}
                        {{ Form::text('username', null, ['placeholder' => 'username@movim.eu or @jappix.com', 'required']) }}
                    </div>

                {{ Form::submit('Authenticate', ['class' => 'button color oppose', 'style' => 'margin-top: 0;'])}}
                {{ Form::close() }}
            </li>
            <li class="clear">
                <span class="primary icon gray"><i class="material-icons">person_add</i></span>
                <div>
                    <p>No account yet?</p>
                    <p><a href="{{ route('accounts.register') }}">Create one in a few clicks…</a></p>
                </div>
            </li>
        </ul>

        <ul class="list">
            <li>
                <span class="primary icon bubble blue">
                    <i class="material-icons">info</i>
                </span>
                <div>
                    <p></p>
                    <p class="all">
                        The account management panel is only there to manage your Movim XMPP account.
                        If you actually want to use your account, please login with your standard credentials using <a target="_blank" href="https://movim.eu/">Movim</a> or <a target="_blank" href="https://xmpp.org/software/clients.html">any other XMPP client</a>.
                    </p>
                </div>
            </li>
        </ul>

    </div>
</div>

@endsection
