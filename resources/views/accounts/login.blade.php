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

<div class="card shadow">
    <div class="block container">
        @include('parts.errors')

        <ul class="list middle">
            <li>
                <div>
                    <p></p>
                    <p class="all">Enter your Movim account to receive a chat message (and an email if configured) containing a unique link to authenticate you</p>
                </div>
            </li>
            <li>
                <span class="primary icon gray"><i class="material-icons">security</i></span>
                {{ Form::open(['method' => 'POST', 'action' => ['AccountsController@requestAuthentication'], 'style' => 'padding-right: 0;']) }}

                    <div>
                        {{ Form::label('username', 'Movim account') }}
                        {{ Form::text('username', null, ['placeholder' => 'username@movim.eu or @jappix.com', 'required']) }}
                    </div>

                {{ Form::submit('Authenticate', ['class' => 'button color oppose', 'style' => 'margin-top: 0; margin: 0 auto;'])}}
                {{ Form::close() }}
            </li>
            <br />
            <hr />
            <br />
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
                        If you actually want to use your account, please login with your standard credentials using <a target="_blank" href="https://movim.eu/">Movim</a> or <a target="_blank" href="https://xmpp.org/software/">any other XMPP client</a>.
                    </p>
                </div>
            </li>
        </ul>
    </div>
</div>

@endsection
