@extends('layouts.movim', ['title' => 'Server registered'])

@section('content')

<div class="block container">
    <div class="placeholder">
        <i class="material-symbols">checklist</i>
        <h4>Movim server registered</h4>

        <a href="{{ route('servers.index') }}" class="button color">
            <i class="material-symbols">view_list</i>
            Go back to Servers list
        </a>
    </div>
</div>

@endsection