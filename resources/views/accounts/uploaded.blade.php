@extends('layouts.movim', ['title' => 'Uploaded files'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <span onclick="redirect('{{ route('accounts.panel') }}')" class="active primary icon gray">
                <i class="material-symbols">chevron_left</i>
            </span>
            <div>
                <p class="center">Account Panel</p>
                <p class="center">Uploaded files</p>
            </div>
        </li>
    </ul>
</header>

<div class="block container">
    <ul class="list middle">
        <li>
            <span class="primary icon gray bubble">
                <i class="material-symbols">info</i>
            </span>
            <div>
                <p>Informations</p>
                <p>Browse all the files you uploaded using your XMPP account</p>
            </div>
        </li>
    </ul>
    <br />
    <hr />
    <ul class="list middle">
        <li class="subheader">
            <div>
                <p>Files</p>
            </div>
        </li>
        @foreach ($account->getFiles() as $file)
            <li>
                <span class="control icon gray active">
                    <a href="{{ $file->uri }}" target="_blank">
                        <i class="material-symbols">insert_drive_file</i>
                    </a>
                </span>
                <div>
                    <p class="normal line">
                        <span class="info">{{ $file->formatedSize }}</span>
                        {{ $file->name }}
                    </p>
                    <p>{{ $file->mtime->toDateTimeString() }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>

@endsection
