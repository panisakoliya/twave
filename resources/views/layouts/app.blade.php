<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Home') &#124; {{config('app.name')}}</title>
    @include('includes.styles')
    @stack('styles')
</head>
<body>
<div class="app align-content-stretch d-flex flex-wrap">
    @include('includes.sidebar')
    <div class="app-container">
        @include('includes.header')
        <div class="app-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.scripts')
@stack('scripts')
</body>
</html>
