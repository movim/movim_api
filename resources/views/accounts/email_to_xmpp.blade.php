@extends('layouts.movim', ['title' => 'Email to XMPP'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <span onclick="redirect('{{ route('accounts.panel') }}')" class="active primary icon gray">
                <i class="material-symbols">chevron_left</i>
            </span>
            <div>
                <p class="center">Account Panel</p>
                <p class="center">Email to XMPP</p>
            </div>
        </li>
    </ul>
</header>

<div class="block container">
    <ul class="list middle">
        <li>
            <span class="primary icon gray bubble">
                <img src="/img/miho.jpg">
            </span>
            <div>
                <p>Informations</p>
                <p>The email to XMPP feature will allow you to receive (and only receive!) emails on your XMPP account.<br />
                    Our postwoman Miho will then take care of delivering them.</p>
            </div>
        </li>
        <li>
            <span class="primary icon gray">
                <i class="material-symbols">drafts</i>
            </span>
            <div>
                <p>Textual content only</p>
                <p>There is no SPAM filter or any checkup made on the emails when they are received.<br />
                    Miho will only send the textual content (without any formatting) and without the attached files.</p>
            </div>
        </li>
        <li>
            <span class="primary icon gray">
                <i class="material-symbols">reply</i>
            </span>
            <div>
                <p>No reply</p>
                <p>This is a one way only system, you will not be able to reply to Miho or use your XMPP account in an email client.</p>
            </div>
        </li>
    </ul>
    <br />
    <hr />
    <ul class="list middle">
        <li class="subheader">
            <div>
                <p>Configure</p>
            </div>
        </li>
        @if ($account->email_notification)
            <li class="active" onclick="redirect('{{ route('accounts.setEmailToXMPP', 0) }}')">
                <span class="primary icon gray">
                    <i class="material-symbols">notifications_active</i>
                </span>
                <span class="control icon gray">
                    <i class="material-symbols">chevron_right</i>
                </span>
                <div>
                    <p>Feature currently enabled</p>
                    <p>Disable the feature</p>
                </div>
            </li>
        @else
            <li class="active" onclick="redirect('{{ route('accounts.setEmailToXMPP', 1) }}')">
                <span class="primary icon gray">
                    <i class="material-symbols">notifications_none</i>
                </span>
                <span class="control icon gray">
                    <i class="material-symbols">chevron_right</i>
                </span>
                <div>
                    <p>Feature currently disabled</p>
                    <p>Enable the feature</p>
                </div>
            </li>
        @endif
    </ul>
</div>

@endsection
