@extends('layouts.movim')

@section('content')
<div class="placeholder">
    <i class="material-icons">done</i>

    <h4>Account successfully created</h4>

    <h2>{{ $jid }}</h2>

    <p>You can now login on your favorite client</p>

    @if (!empty($referer))
        <br />
        <a class="button color" href="{{ parse_url($referer)['scheme'] }}://{{ parse_url($referer)['host'] }}">
            Go back to {{ parse_url($referer)['host'] }}
        </a>
    @else
        <p class="center">or one of the following pods of your choice</p>
    @endif
</div>

@if(empty($referer))

<ul class="list flex active">
    @foreach ($pods as $pod)
    <a class="block" href="{{ $pod->url }}">
        <li>
            <span class="control icon gray">
                <i class="material-icons">chevron_right</i>
            </span>
            <div>
                <p>{{ parse_url($pod->url)['host'] }}</p>
                <p>{{ $pod->description }}</p>
            </div>
        </li>
    </a>
    @endforeach
</ul>

@endif

@endsection
