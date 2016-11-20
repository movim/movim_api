@extends('layouts.app')

@section('content')
<h2>Pods</h2>

<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Status</th>
            <th colspan="7">Infos</th>
            <th colspan="2">Actions</th>
        </tr>
        <tbody>
            @foreach ($pods as $pod)
                <tr>
                    <td>{{ $pod->id }}</td>
                    <td>
                        @if($pod->activated)
                            <span class="label label-success">Online</span>
                        @else
                            <span class="label label-danger">Offline</span>
                        @endif
                    </td>
                    <td colspan="3">
                        @if($pod->favorite)
                            <i class="fa fa-star"></i>
                        @endif
                        <a href="{{ $pod->url }}" target="_blank">{{ $pod->url }}</a>
                        (<a href="http://whatismyipaddress.com/ip/{{ $pod->ip }}" target="_blank">{{ $pod->ip }}</a>)
                        @if($pod->rewrite)
                            <i class="fa fa-pencil"></i>
                        @endif
                    </td>

                    <td>
                        <i class="fa fa-users"></i>
                        {{ $pod->connected }}/{{ $pod->population }}
                    </td>
                    <td title="{{$pod->php_version}}"><b>PHP</b> {{ $pod->php_version }}</td>
                    <td>
                        <i class="fa fa-flag"></i>
                        {{ $pod->language }}
                    </td>
                    <td>
                        <i class="fa fa-clock-o"></i>
                        {{ $pod->updated_at }}
                    </td>
                    <td>
                        <a
                            class="btn btn-info btn-xs"
                            href="{{ action('PodsController@refresh', $pod->id) }}"
                            role="button">
                            <i class="fa fa-refresh"></i> Refresh
                        </a>
                    </td>
                    <td>
                        <a
                            class="btn btn-warning btn-xs"
                            href="{{ action('PodsController@edit', $pod->id) }}"
                            role="button">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $pod->version }}</td>

                    <td colspan="8" title="{{$pod->description}}">{{ $pod->description }}</td>

                    <td>
                        {{ Form::open(['method' => 'DELETE', 'action' => ['PodsController@destroy', $pod->id]]) }}
                            <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i> Delete</button>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
