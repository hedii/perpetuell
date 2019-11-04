<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/admin/app.js') }}" defer></script>
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
</head>
<body>
@include('admin.partials.header')
@include('admin.partials.main')
</body>
</html>
