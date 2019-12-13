<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/front/app.css') }}" rel="stylesheet">
</head>
<body>
@includeWhen(Route::is('front.songs.index'), 'front.partials.header')
@yield('content')
<script src="{{ asset('js/front/app.js') }}"></script>
@stack('scripts')
</body>
</html>
