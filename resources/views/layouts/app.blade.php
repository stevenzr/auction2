<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Google Analytics -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-111884808-1', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@lang('header.description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="image/x-icon" href="{{ staticImage('favicon.ico') }}" rel="icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://static.sander.borret.mtantwerp.eu" rel="dns-prefetch">
    <title>@yield('title') | {{ config('app.name') }}</title>
</head>
<body>
    @include('partials.logo', ['position' => 'top'])
    @include('partials.header')
    @yield('main')
    @include('partials.footer')
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
