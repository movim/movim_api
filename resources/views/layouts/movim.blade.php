<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @isset($title) · {{ $title }} @endisset</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://mov.im/theme/css/style.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/elevation.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/notification.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/header.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/listn.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/grid.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/article.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/form.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/icon.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/dialog.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/drawer.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/card.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/table.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/color.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/block.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/menu.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/fonts.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/title.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/typo.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/elevation.css?2" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/chip.css?2" type="text/css" />
    <link rel="stylesheet" href="https://movim.eu/css/fonts.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/material-design-iconic-font.min.css?2" type="text/css" />

    <link rel="stylesheet" href="/css/movim.css?6" type="text/css" />

    <link rel="shortcut icon" href="img/favicon.ico" />
    <link rel="icon" type="image/png" href="img/48.png" sizes="48x48">
    <link rel="icon" type="image/png" href="img/96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="img/128.png" sizes="128x128">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body class="">
    <header>
        <section>
            <ul class="list thick">
            <li>
                <span class="primary icon gray">
                    <a href="{{ route('servers.index') }}"><img src="https://movim.eu/img/vectorial.svg"></a>
                </span>
                <span class="control icon active color blue bubble" onclick="redirect('{{ route('accounts.panel') }}')">
                    <i class="material-icons">person</i>
                </span>
                <div>
                    <p><a id="app_title" href="{{ route('servers.index') }}">{{ config('app.name') }}</a></p>
                </div>
            </li>
        </ul>
        </section>
    </header>
    <section class="large" @if(isset($section_class)) class="{{ $section_class }}" @endif>
        @yield('content')

        <footer>
            <hr />
            <ul class="list middle">
                <li>
                    <div>
                        <p class="center">Copyright 2008 - 2023 – <a href="https://edhelas.movim.eu">Timothée Jaussoin</a></p>
                        <p class="center">
                            <a href="{{ route('accounts.login') }}">Account Panel</a>
                            - <a href="/api">API & Tools</a>
                            - <a href="https://github.com/movim/movim_api">Github sources</a>
                            - <a href="https://movim.eu/">movim.eu</a>
                        </p>
                    </div>
                </li>
            </ul>
        </footer>
    </section>

    <!-- Scripts -->
    <script src="/js/scripts.js?2"></script>
</body>

</html>