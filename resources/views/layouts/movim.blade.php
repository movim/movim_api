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
    <link rel="stylesheet" href="https://mov.im/theme/css/style.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/notification.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/header.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/listn.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/grid.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/article.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/form.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/icon.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/dialog.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/drawer.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/card.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/table.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/color.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/block.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/menu.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/fonts.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/title.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/typo.css?1" type="text/css" />
    <link rel="stylesheet" href="https://mov.im/theme/css/material-design-iconic-font.min.css?1" type="text/css" />

    <link rel="stylesheet" href="/css/movim.css?4" type="text/css" />
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <main>
        <section @if(isset($section_class)) class="{{ $section_class }}"@endif>
            @yield('content')
            <footer>
                <ul class="list middle">
                    <li>
                        <div>
                            <p></p>
                            <p class="center">
                                <a href="{{ route('accounts.login') }}">Account Panel</a>
                                - <a href="/api">API & Tools</a>
                                - <a href="https://movim.eu/">movim.eu</a>
                            </p>
                        </div>
                    </li>
                </ul>
            </footer>
        </section>
    </main>

    <!-- Scripts -->
    <script src="/js/scripts.js?1"></script>
</body>
</html>
