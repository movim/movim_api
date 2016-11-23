@extends('layouts.movim')

@section('content')

<header>
    <ul class="list middle">
        <li>
            <p class="center">Account Creation</p>
        </li>
    </ul>
</header>

<div class="flex">

    <div class="block on_desktop">
            <div class="placeholder icon account">
            <h4>Create a new account</h4>
            <h4>…and start playing</h4>
            </div>
    </div>

    <div class="block">
        @if ($errors->any())
            <ul class="list middle">
                <li>
                    <span class="primary icon color bubble red">
                        <i class="zmdi zmdi-info"></i>
                    </span>
                    <p>Invalid form</p>
                    <p>
                        @foreach ($errors->all() as $error)
                            {{$error}}<br />
                        @endforeach
                    </p>
                </li>
            </ul>
        @endif

        {{ Form::open(['method' => 'POST', 'action' => ['AccountsController@store'], 'class' => 'padded_top_bottom']) }}

            {{ Form::hidden('referer', $referer) }}
            <div>
                <span style="color: gray;
                    font-weight: bold;
                    text-align: left;
                    font-size: 2rem;
                    top: 4rem;
                    float: right;
                    position: relative;
                    line-height: 2rem;
                    padding: 1rem;
                    width: 15rem;
                    box-sizing: border-box;">
                    @movim.eu
                </span>
                {{ Form::label('username', 'Username') }}
                {{ Form::text('username', null, ['placeholder'=>'username', 'style' => 'width: calc(100% - 15rem); text-align: right;', 'pattern' => '^[^\u0000-\u001f\u0020\u0022\u0026\u0027\u002f\u003a\u003c\u003e\u0040\u007f\u0080-\u009f\u00a0]+$']) }}
            </div>
            <div>
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['placeholder'=>'Your password']) }}
            </div>
            <div>
                {{ Form::password('password_confirmation', ['placeholder'=>'Retype your password', 'style' => 'padding-top: 2rem']) }}
            </div>

            <div>
                <br />
                {!! app('captcha')->display(); !!}
            </div>

            {{ Form::submit('Create', ['class'=>'button color oppose', 'style' => 'margin-top: 3rem;'])}}
        {{ Form::close() }}

    </div>

</div>

@endsection
