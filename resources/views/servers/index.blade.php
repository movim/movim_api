@extends('layouts.movim', ['section_class' => 'large'])

@section('content')

<ul class="list thick">
    <li>
        <div>
            <a class="button oppose flat gray" href="{{ route('servers.add') }}">
                <i class="material-icons">add</i>
                Add your server
            </a>
            <p>Servers</p>
            <p>Movim is federated, the network is composed by many <b>servers</b>.<br />You can choose to join the one you prefer and still share with the users of all the others.</p>
        </div>
    </li>
</ul>

<hr />

<ul class="list thick">
    <li>
        <div>
            <p></p>
            <p>
                <a href="#" class="chip outline"><i class="material-icons icon green">check</i> Open</a> servers can be joined using any XMPP account,
                <a href="#" class="chip outline"><i class="material-icons icon red">check</i> Private</a> servers requires a specific XMPP account to join
            </p>
        </div>
    </li>
</ul>

<ul class="list card middle flex third servers">
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
                @if ($server->whitelist()->count() > 0)
                    <a class="chip outline"><i class="material-icons icon red">check</i> Private</a>
                @else
                    <a class="chip outline"><i class="material-icons icon green">check</i> Open</a>
                @endif
                <a href="https://{{ $server->domain }}" target="_blank" class="button flat oppose color green tiny">Join</a>
                <p>{{ $server->domain }}</p>
                <p>{{ $server->description}}</p>

                <p>
                    <i class="material-icons icon-text icon gray">people</i> Pop. {{ $server->population }} · <i class="material-icons icon-text icon green">people</i> Connected {{ $server->connected }}
                </p>
            </div>
        </li>
    @endforeach
</ul>

@endsection