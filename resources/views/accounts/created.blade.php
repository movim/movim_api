@extends('layouts.movim')

@section('content')
    <div class="placeholder icon clipboard">
    <h4>Account successfully created</h4>

    <h2>{{ $jid }}</h2>

    <p>You can now login on your favorite client</p>

    @if (!empty($referer))
    <a class="button color" href="{{ parse_url($referer)['scheme'] }}://{{ parse_url($referer)['host'] }}">
        Go back to {{ parse_url($referer)['host'] }}
    </a>
    @endif
</div>
@endsection
