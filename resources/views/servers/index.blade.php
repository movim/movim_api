@extends('layouts.app')

@section('content')

<h2>XMPP Servers <small>{{ sizeof($servers) }}</small></h2>
<div class="table-responsive table-striped">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Domain</th>
                <th colspan="5">Infos</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servers as $server)
                <tr>
                    <td>{{ $server->id }}</td>
                    <td>{{ $server->domain }}</td>
                    <td><a href="{{ $server->url }}" target="_blank">{{ $server->url }}</a></td>
                    <td>{{ $server->title }}</td>
                    <td>{{ $server->description }}</td>
                    <td>{{ $server->geo_country }}</td>
                    <td>{{ $server->geo_city }}</td>
                    <td>
                        <a
                            class="btn btn-warning btn-sm"
                            href="{{ action('ServersController@edit', $server->id) }}"
                            role="button">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                    <td>
                        {{ Form::open(['method' => 'DELETE', 'action' => ['ServersController@destroy', $server->id]]) }}
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fa fa-times"></i> Delete
                            </button>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a
        class="btn btn-success pull-right"
        href="{{ action('ServersController@create') }}"
        role="button">
        New
    </a>
</div>

@endsection
