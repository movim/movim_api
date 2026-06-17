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
    <form method="POST" action="{{ route('accounts.setChangePassword') }}" accept-charset="UTF-8" id="registration_form" class="padded_top_bottom">
        @csrf
        @include('parts.errors')

        <div>
            <label for="password">Password</label>
            <input required="" placeholder="Your new password" name="password" type="password" value="" id="password">
        </div>
        <div>
            <label for="password_confirmation">Confirm your password</label>
            <input required="" placeholder="Confirm your password" name="password_confirmation" type="password" value="" id="password_confirmation">
        </div>

        <div>
            <br />
            {!! HCaptcha::renderJs() !!}
            {!! HCaptcha::display() !!}
        </div>

        <input class="button color oppose" style="margin-top: 3rem;" type="submit" value="Change">
    </form>
</div>

@endsection
