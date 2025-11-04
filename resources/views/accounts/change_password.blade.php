@extends('layouts.movim', ['title' => 'Password change'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <span onclick="redirect('{{ route('accounts.panel') }}')" class="active primary icon gray">
                <i class="material-symbols">chevron_left</i>
            </span>
            <div>
                <p class="center">Account Panel</p>
                <p class="center">Change your account password</p>
            </div>
        </li>
    </ul>
</header>

<div class="block container">
    {{ Form::open([
        'method' => 'POST',
        'action' => ['AccountsController@setChangePassword'],
        'class' => 'padded_top_bottom',
        'id' => 'registration_form'
    ]) }}
        @include('parts.errors')

        <div>
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['required', 'placeholder'=>'Your new password']) }}
        </div>
        <div>
            {{ Form::label('password_confirmation', 'Confirm your password') }}
            {{ Form::password('password_confirmation', ['required', 'placeholder'=>'Confirm your password', 'style' => 'margin-top: -1rem']) }}
        </div>

        <div>
            <br />
            {!! HCaptcha::renderJs() !!}
            {!! HCaptcha::display() !!}
        </div>

        {{ Form::submit('Change', ['class'=>'button color oppose', 'style' => 'margin-top: 3rem;'])}}
    {{ Form::close() }}
</div>

@endsection
