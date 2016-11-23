@extends('layouts.movim')

@section('content')
    <div class="placeholder icon clipboard">
    <h4>Account successfully created</h4>

    <h2>{{ $jid }}</h2>

    @if (isset($referer))
    <a class="button color" href="{{ $referer }}">
        Go back to {{ parse_url($referer)['host'] }}
    </a>
    @endif
</div>
@endsection
