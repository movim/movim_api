@extends('layouts.app')

@section('content')
<h1>Edit Pod <small><a href="{{ $pod->url }}" target="_blank">{{ $pod->url }}</a></small></h1>

{{ Form::model($pod, array('route' => array('pods.update', $pod->id), 'method' => 'put')) }}
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', null, array('class'=>'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('activated', 'Activated') }}
        {{ Form::checkbox('activated') }}
    </div>
    <div class="form-group">
        {{ Form::label('favorite', 'Favorite') }}
        {{ Form::checkbox('favorite') }}
    </div>

    {{ Form::submit('Update', array('class'=>'btn btn-success'))}}

    <a
        class="btn btn-link"
        href="{{ action('PodsController@index') }}"
        role="button">
        Back
    </a>
{{ Form::close() }}

@endsection
