@extends('layouts.movim', ['title' => 'Register a Server'])

@section('content')

<div class="block container">
    <div class="placeholder">
        <i class="material-icons">dns</i>
        <h4>Register a new Movim server</h4>
    </div>
    <ul class="list">
        <li>
            <span class="primary icon gray">
                <i class="material-icons">info</i>
            </span>
            <div>
                <p>Register your Movim server in a few easy steps.</p>
                <p>Before filling and submitting the form you must follow those requirements:<br />
                    <ol>
                        <li>Ensure that the entered domain or subdomain is publicly available and that Movim is setup at the root of it (sub-directories are not supported).</li>
                        <li>Ensure that you have at least one administrator enabled on your instance, we will send a unique token as a XMPP message to them to validate the registration.</li>
                        <li>Ensure that your server details are properly filled in the admin panel (description, banner, authorized XMPP servers...).</li>
                        <li>Movim 0.21.1 minimum is required.</li>
                    </ol>
                </p>
            </div>
        </li>
    </ul>

    <hr style="margin: 3rem 0;" />

    @include('parts.errors')

    <ul class="list">
        <li>
            {{ Form::open([
                'method' => 'POST',
                'route' => 'servers.create'
            ]) }}

            <div>
                {{ Form::label('domain', 'Domain') }}
                {{ Form::text('domain', null, ['placeholder'=>'Your Movim domain, e.g. movim.domain.org, movim-community.net']) }}
            </div>

            <div>
                <br />
                {!! HCaptcha::renderJs() !!}
                {!! HCaptcha::display() !!}
            </div>

            {{ Form::submit('Register', ['class'=>'button color oppose'])}}
            {{ Form::close() }}
        </li>
    </ul>
</div>

@endsection