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
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/notification.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/header.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/listn.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/grid.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/article.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/form.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/icon.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/dialog.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/drawer.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/card.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/table.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/color.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/block.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/menu.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/fonts.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/title.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/typo.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/theme/css/material-design-iconic-font.min.css" type="text/css" />

    <link rel="stylesheet" href="/css/movim.css" type="text/css" />
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
            <div>
            @yield('content')
            </div>
        </section>
    </main>

    <!-- Scripts -->
    <script src="/js/scripts.js"></script>
</body>
</html>
