@extends('layouts.movim')

@section('content')

<header>
    <ul class="list middle">
        <li>
            <div>
                <p class="center">Account Creation</p>
            </div>
        </li>
    </ul>
</header>

<div class="flex">
    <div class="block">
        @if (!$registration)
            <h2>Registrations currently closed</h2>
        @else
            @if ($errors->any())
                <ul class="list middle">
                    <li>
                        <span class="primary icon color bubble red">
                            <i class="material-icons">warning</i>
                        </span>
                        <div>
                            <p>Invalid form</p>
                            <p>
                                @foreach ($errors->all() as $error)
                                    {{$error}}<br />
                                @endforeach
                            </p>
                        </div>
                    </li>
                </ul>
            @endif

            {{ Form::open([
                'method' => 'POST',
                'action' => ['AccountsController@store'],
                'class' => 'padded_top_bottom',
                'id' => 'registration_form'
            ]) }}
                {{ Form::hidden('referer', $referer) }}
                <div class="domain">
                    <div class="select">
                        <select name="domain">
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
                    {{ Form::label('username', 'Username') }}
                    {{ Form::text('username', null, ['placeholder'=>'username', 'style' => 'text-align: right;', 'pattern' => '^[^\u0000-\u001f\u0020\u0022\u0026\u0027\u002f\u003a\u003c\u003e\u0040\u007f\u0080-\u009f\u00a0]+$']) }}
                </div>
                <div>
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', ['placeholder'=>'Your password']) }}
                </div>
                <div>
                    {{ Form::password('password_confirmation', ['placeholder'=>'Retype your password', 'style' => 'padding-top: 2rem']) }}
                </div>

                <div>
                    {{ Form::label('email', 'Email (optional)') }}
                    {{ Form::text('email', null, ['placeholder'=>'username@server.com']) }}
                </div>

                <div class="email_info">
                    <ul class="list thin">
                        <li>
                            <div>
                                <p></p>
                                <p>Setting your email address could allow you to recover your password. It can also be set later.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div>
                    <ul class="list">
                        <li>
                            <span class="primary">
                                <div class="action">
                                    <div class="checkbox">
                                    {{ Form::checkbox('legals', 'agreed', false, ['id' => 'legals']) }}
                                    {{ Form::label('legals', ' ') }}
                                    </div>
                                </div>
                            </span>
                            <div>
                                <p class="line normal">Terms and Conditions</p>
                                <p>I agree that my IP and detected location (<a href="https://www.php.net/manual/en/intro.geoip.php">using GeoIP</a>) will be logued during the registration process.</p>
                                <p>I agree with the <a href="{{ action('AccountsController@legals') }}" target="_blank">Terms and Conditions</a></p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div>
                    <br />
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                </div>

                {{ Form::submit('Create', ['class'=>'button color oppose', 'style' => 'margin-top: 3rem;'])}}
            {{ Form::close() }}
        @endif

    </div>

    <div class="block on_desktop">
        <div class="placeholder">
            <i class="material-icons">person_add</i>
            <h4>Create a new account</h4>
            <h4>…and start playing</h4>
        </div>
    </div>

</div>

@endsection
