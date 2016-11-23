@extends('layouts.movim')

@section('content')
    <div class="placeholder icon clipboard">
    <h4>Account successfully created</h4>

    <h2>{{ $jid }}</h2>

    <p>You can now login with it on your favorite client</p>

    @if (!empty($referer))
    <a class="button color" href="{{ $referer }}">
        Go back to {{ parse_url($referer)['host'] }}
    </a>
    @endif
</div>
@endsection
