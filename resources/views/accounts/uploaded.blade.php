@extends('layouts.movim', ['title' => 'Uploaded files'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <span onclick="redirect('{{ route('accounts.panel') }}')" class="active primary icon gray">
                <i class="material-icons">chevron_left</i>
            </span>
            <p class="center">Account Panel</p>
            <p class="center">Uploaded files</p>
        </li>
    </ul>
</header>

<ul class="list middle">
    <li>
        <span class="primary icon gray bubble">
            <i class="material-icons">info</i>
        </span>
        <p>Informations</p>
        <p>Browse all the files you uploaded using your XMPP account</p>
    </li>
</ul>
<br />
<hr />
<ul class="list middle">
    <li class="subheader">
        <p>Files</p>
    </li>
    @foreach ($account->getFiles() as $file)
        <li>
            <span class="control icon gray active">
                <a href="{{ $file->uri }}" target="_blank">
                    <i class="material-icons">insert_drive_file</i>
                </a>
            </span>
            <p class="normal line">
                <span class="info">{{ $file->formatedSize }}</span>
                {{ $file->name }}
            </p>
            <p>{{ $file->mtime->toDateTimeString() }}</p>
        </li>
    @endforeach
</ul>

@endsection
