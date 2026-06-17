@extends('layouts.movim', ['title' => 'Create an account'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <div>
                <p class="center">Create a Movim account</p>
                <p class="center">An unique XMPP account for all your devices</p>
            </div>
        </li>
    </ul>
</header>

<div class="block container">
    @if (!$registration)
        <h2>Registrations currently closed</h2>
    @else
        @include('parts.errors')

        <form method="POST" action="{{ route('accounts.store') }}" accept-charset="UTF-8" id="registration_form" class="padded_top_bottom">
            @csrf
            <input name="referer" type="hidden" value="{{ $referer }}">
            <div class="domain">
                <div class="select">
                    <select name="domain" onchange="checkUsername()">
                        @foreach($domains as $domain)
                            <option value="{{ $domain }}"
                            {{ old('domain') == $domain ? 'selected' : '' }}
                            >
                                {{ $domain }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <label for="domain">Domain</label>
            </div>


            <div class="at">
                <span style="color: gray;
                    font-weight: bold;
                    font-size: 2rem;
                    box-sizing: border-box;">
                    @
                </span>
            </div>

            <div class="username">
                <label for="username">Username</label>
                <input placeholder="username" oninput="checkUsername()" required="" pattern="^[^\u0000-\u001f\u0020\u0022\u0026\u0027\u002f\u003a\u003c\u003e\u0040\u007f\u0080-\u009f\u00a0]+$" name="username" type="text" id="username">
            </div>
            <ul class="list hide" id="resolved_username_block">
                <li>
                    <div>
                        <p class="center">Your account will be</p>
                        <p class="center" id="resolved_username"></p>
                    </div>
                </li>
            </ul>
            <div>
                <label for="password">Password</label>
                <input required="" placeholder="Your password" name="password" type="password" value="" id="password">
            </div>
            <div>
                <label for="password_confirmation">Confirm your password</label>
                <input required="" placeholder="Confirm your password" name="password_confirmation" type="password" value="" id="password_confirmation">
            </div>

            <div>
                <label for="email">Email (optional)</label>
                <input placeholder="username@server.com" name="email" type="text" id="email">
            </div>

            <div class="email_info">
                <ul class="list thin">
                    <li>
                        <div>
                            <p></p>
                            <p>Set your email could allow you to recover your password.<br /> It can also be set or removed later.</p>
                        </div>
                    </li>
                </ul>
            </div>

            <br />

            <div>
                <ul class="list">
                    <li>
                        <span class="control">
                            <div class="action">
                                <div class="checkbox">
                                    <input id="legals" name="legals" type="checkbox" value="agreed">
                                    <label for="legals"></label>
                                </div>
                            </div>
                        </span>
                        <div>
                            <p class="line">Terms and Conditions</p>
                            <p>I agree that my IP and detected location will be logged during the registration process.</p>
                            <p>I agree with the <a href="{{ route('legals') }}" target="_blank">Terms and Conditions</a></p>
                        </div>
                    </li>
                </ul>
            </div>

            <div>
                <br />
                {!! HCaptcha::renderJs() !!}
                {!! HCaptcha::display() !!}
            </div>

            <input class="button color oppose" style="margin-top: 3rem;" type="submit" value="Create">
        </form>
    @endif
</div>

@endsection
