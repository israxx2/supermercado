<!doctype html>
<html lang="{{ app()->getLocale() }}">
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="icon" href="/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100:300,400,500,700,900|Material+Icons" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <noscript>
        <strong>We're sorry but prueba doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
        <div id="app"></div>
    </body>
</html>
