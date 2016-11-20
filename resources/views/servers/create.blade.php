@extends('layouts.app')

@section('content')

<h1>New Server</h1>

{{ Form::model('server', array('route' => array('servers.store'), 'method' => 'post')) }}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class'=>'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('domain', 'Domain') }}
        {{ Form::text('domain', null, array('class'=>'form-control')) }}
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

    {{ Form::submit('Create', array('class'=>'btn btn-success'))}}

    <a
        class="btn btn-link"
        href="{{ action('ServersController@index') }}"
        role="button">
        Back
    </a>
{{ Form::close() }}

<br />

@endsection
