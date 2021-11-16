@extends('layouts.movim', ['title' => 'Account created'])

@section('content')
<div class="placeholder">
    <i class="material-icons">done</i>

    <h4>Account successfully created</h4>

    <h2>{{ $jid }}</h2>

    <p>You can now login on your favorite client</p>

    @if (!empty($referer))
        <br />
        <a class="button color" href="{{ parse_url($referer)['scheme'] }}://{{ parse_url($referer)['host'] }}">
            Go back to {{ parse_url($referer)['host'] }}
        </a>
    @else
        <p class="center">or one of the following pods of your choice</p>
    @endif
</div>

<div class="card shadow">
    <div class="block container">
        <ul class="list active">
            <a class="block" target="_blank" href="https://dino.im/">
                <li>
                    <span class="primary icon purple">
                        <i class="material-icons">laptop</i>
                    </span>
                    <span class="control icon gray">
                        <i class="material-icons">chevron_right</i>
                    </span>
                    <div>
                        <p>Dino for your laptop or desktop</p>
                        <p>A modern open-source chat client for the desktop</p>
                    </div>
                </li>
            </a>
            <a class="block" target="_blank" href="https://play.google.com/store/apps/details?id=eu.siacs.conversations">
                <li>
                    <span class="primary icon green">
                        <i class="material-icons">android</i>
                    </span>
                    <span class="control icon gray">
                        <i class="material-icons">chevron_right</i>
                    </span>
                    <div>
                        <p>Conversations for Android</p>
                        <p>A free and open source Jabber/XMPP client for Android</p>
                    </div>
                </li>
            </a>
        </ul>

        @if(empty($referer))

        <ul class="list active">
            <a class="block" href="https://mov.im/">
                <li>
                    <span class="control icon gray">
                        <i class="material-icons">chevron_right</i>
                    </span>
                    <div>
                        <p>mov.im</p>
                        <p>Official Movim Pod</p>
                    </div>
                </li>
            </a>
        </ul>

        @endif

    </div>
</div>

@endsection
