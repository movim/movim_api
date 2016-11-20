@extends('layouts.app')

@section('content')

<h1>Edit Server</h1>

{{ Form::model($server, array('route' => array('servers.update', $server->id), 'method' => 'put')) }}
    {{ Form::hidden('domain', $server->domain) }}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class'=>'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('url', 'URL') }}
        {{ Form::text('url', null, array('class'=>'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', null, array('class'=>'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('geo_country', 'Country') }}
        {{ Form::text('geo_country', null, array('class'=>'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('geo_city', 'City') }}
        {{ Form::text('geo_city', null, array('class'=>'form-control')) }}
    </div>

    {{ Form::submit('Update', array('class'=>'btn btn-success'))}}

    <a
        class="btn btn-link"
        href="{{ action('ServersController@index') }}"
        role="button">
        Dashboard
    </a>
{{ Form::close() }}

@endsection
