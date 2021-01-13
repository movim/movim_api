@extends('layouts.movim', ['title' => 'Account Panel'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <span onclick="redirect('{{ route('accounts.logout') }}')" class="active control icon gray">
                <i class="material-icons">exit_to_app</i>
            </span>
            <div>
                <p class="center">Account Panel</p>
                <p class="center">{{ $account->jid }}</p>
            </div>
        </li>
    </ul>
</header>

<div class="card shadow">
    <div class="block container">
        <ul class="list thick">
            <li>
                <span class="primary icon gray">
                    <i class="material-icons">info</i>
                </span>
                <div>
                    <p></p>
                    <p>Welcome on your account configuration panel, here you will be able to manage your account related data and configure a few available features</p>
                </div>
            </li>

            <li class="active" onclick="redirect('{{ route('accounts.emailToXMPP') }}')">
                <span class="primary icon gray">
                    <i class="material-icons">
                        @if ($account->email_notification)
                            notifications_active
                        @else
                            notifications_none
                        @endif
                    </i>
                </span>
                <span class="control icon gray">
                    <i class="material-icons">chevron_right</i>
                </span>
                <div>
                    <p>Email to XMPP notifications</p>
                    <p>
                        @if ($account->email_notification)
                            Enabled
                        @else
                            Disabled
                        @endif
                    </p>
                </div>
            </li>

            <li class="active" onclick="redirect('{{ route('accounts.uploaded') }}')">
                <span class="primary icon gray">
                    <i class="material-icons">folder_shared</i>
                </span>
                <span class="control icon gray">
                    <i class="material-icons">chevron_right</i>
                </span>
                <div>
                    <p>Uploaded files</p>
                    <p>Browser and manage your uploaded files</p>
                </div>
            </li>
        </ul>
    </div>
</div>

@endsection
