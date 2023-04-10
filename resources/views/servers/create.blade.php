@extends('layouts.movim', ['title' => 'Server registration confirmation'])

@section('content')

<div class="block container">
    <div class="placeholder">
        <i class="material-icons">mark_chat_unread</i>
        <h4>Confirm your registration</h4>
    </div>
    <ul class="list">
        <li>
            <span class="primary icon gray">
                <i class="material-icons">info</i>
            </span>
            <div>
                <p>Please confirm your registration</p>
                <p>A unique registration link was sent to the administrators of the <b>{{ $domain }}</b> server</p>
            </div>
        </li>
    </ul>
</div>


@endsection