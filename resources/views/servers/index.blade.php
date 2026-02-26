@extends('layouts.movim', ['title' => 'Servers list'])

@section('content')

<ul class="list thick">
    <li>
        <div>
            <a class="button oppose flat gray" href="{{ route('servers.add') }}">
                <i class="material-symbols">add</i>
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
                <i class="material-symbols icon-text icon green">check</i> Open servers can be joined using any XMPP account,
                <i class="material-symbols icon-text icon red">check</i> Restricted servers requires a specific XMPP account to join
            </p>
        </div>
    </li>
</ul>

<ul class="list">
    <li class="subheader block large">
        <div>
            <p>
                Servers
                <span class="info">{{ $servers->count() }}</span>
            </p>
        </div>
    </li>
</ul>
@php($restrictedSection = false)
@php($outdatedSection = false)
<ul id="servers" class="list card middle flex third servers">
    @foreach ($servers as $server)
        @if ($server->whitelist_count > 0 && $restrictedSection == false)
            <br />
            <li class="subheader">
                <div>
                    <p>Restricted</p>
                </div>
            </li>
            @php($restrictedSection = true)
        @endif
        @if ($server->outdated && $outdatedSection == false)
            <br />
            <li class="subheader">
                <div>
                    <p>Oudated</p>
                </div>
            </li>
            @php($outdatedSection = true)
        @endif
        <li class="block @if ($server->outdated) outdated @endif">
            <img src="{{ $server->banner }}"/>
            <div>
                <a href="https://{{ $server->domain }}" target="_blank" class="chip outline color green">
                    <i class="material-symbols">login</i>
                    Join
                </a>

                <p class="line">
                    <span class="info">{{ $server->version }}</span>
                    {{ $server->domain }}
                </p>
                <p class="line two">{{ $server->description}}</p>

                <p title="Connected / Total population">
                    <i class="material-symbols icon-text icon green">people</i> {{ $server->connected }} @if($server->maxsessions > 0)/{{ $server->maxsessions }}@endif • Pop: {{ $server->population }}
                    •

                    @if ($server->whitelist()->count() > 0)
                        <i class="material-symbols icon-text icon red">check</i> Restricted
                    @else
                        <i class="material-symbols icon-text icon green">check</i> Open
                    @endif

                    @if ($server->outdated)
                        • <i class="material-symbols icon-text icon blue">history</i> Outdated
                    @endif
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