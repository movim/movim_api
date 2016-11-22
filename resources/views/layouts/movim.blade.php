<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!--<link href="/css/app.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/notification.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/header.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/listn.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/grid.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/article.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/form.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/icon.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/dialog.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/drawer.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/card.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/table.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/color.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/block.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/menu.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/fonts.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/title.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/typo.css" type="text/css" />
    <link rel="stylesheet" href="https://nl.movim.eu/themes/material/css/material-design-iconic-font.min.css" type="text/css" />
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
    <script src="/js/app.js"></script>
</body>
</html>
