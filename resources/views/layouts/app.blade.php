<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sensomat') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sensomat.css') }}" rel="stylesheet">

    <!-- FavIcon -->
    <!--<link rel="icon" type="image/png" href="/assets/Sensomat_Logo_FavIcon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="public/assets/Sensomat_Logo_AppIcon.png">-->

    <link rel="apple-touch-icon" sizes="180x180" href="public/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="public/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="public/assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="public/assets/favicon/safari-pinned-tab.svg" color="#005ba4">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-TileImage" content="public/assets/favicon/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

</head>

<body>
    <div id="app">
        <component>
            <router-view />
        </component>
    </div>
</body>

</html>