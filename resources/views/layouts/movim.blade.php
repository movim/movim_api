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
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/style.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/notification.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/header.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/listn.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/grid.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/article.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/form.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/icon.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/dialog.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/drawer.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/card.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/table.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/color.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/block.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/menu.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/fonts.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/title.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/typo.css?1" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/material-design-iconic-font.min.css?1" type="text/css" />

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
        <section>
            @yield('content')
            <footer>
                <ul class="list middle">
                    <li>
                        <div>
                            <p></p>
                            <p class="center">
                                <a href="{{ route('accounts.login') }}">Account Panel</a>
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
