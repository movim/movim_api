@extends('layouts.movim', ['title' => 'Servers list'])

@section('content')

<ul class="list thick">
    <li>
        <div>
            <a class="button oppose flat gray" href="{{ route('servers.add') }}">
                <i class="material-icons">add</i>
                Add your server
            </a>
            <p>Servers</p>
            <p class="all">Movim is federated, the network is composed by many <b>servers</b>.<br />You can choose to join the one you prefer and still share with the users of all the others.</p>
        </div>
    </li>
</ul>

<hr />

<ul class="list thick">
    <li>
        <div>
            <p></p>
            <p class="all">
                <i class="material-icons icon-text icon green">check</i> Open servers can be joined using any XMPP account,
                <i class="material-icons icon-text icon red">check</i> Restricted servers requires a specific XMPP account to join
            </p>
        </div>
    </li>
</ul>

<ul id="servers" class="list card middle flex third servers">
    <li class="subheader block large">
        <div>
            <p>
                Servers
                <span class="info">{{ $servers->count() }}</span>
            </p>
        </div>
    </li>
    @foreach ($servers as $server)
        <li class="block">
            <img src="{{ $server->banner }}"/>
            <div>
                <a href="https://{{ $server->domain }}" target="_blank" class="chip outline color green">
                    <i class="material-icons">login</i>
                    Join
                </a>

                <p class="line">{{ $server->domain }}</p>
                <p class="line two">{{ $server->description}}</p>

                <p title="Connected / Total population">
                    <i class="material-icons icon-text icon green">people</i> {{ $server->connected }} / {{ $server->population }}
                    |

                    @if ($server->whitelist()->count() > 0)
                        <i class="material-icons icon-text icon red">check</i> Restricted
                    @else
                        <i class="material-icons icon-text icon green">check</i> Open
                    @endif
                    <span class="info">{{ $server->version }}</span>
                </p>
            </div>
        </li>
    @endforeach
</ul>

<ul class="list">
    <li>
        <div>
            <p></p>
            <p>The servers list is refreshed every hour</p>
        </div>
    </li>
</ul>

@endsection