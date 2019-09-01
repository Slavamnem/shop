<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Milan Shop') }}</title>--}}
    <title>{{ 'Milan Shop' }}</title>

    <!-- Styles -->
    <link href="../public/css/app.css" rel="stylesheet">
    <link href="../public/css/main.css" rel="stylesheet">
    {{--<link rel='stylesheet' href="{{ asset('css/main.css') }}">--}}


    {{----}}
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('public/admin/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/libs/css/style.css") }} ">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/css/main.css") }} ">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/charts/chartist-bundle/chartist.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/charts/morris-bundle/morris.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/charts/c3charts/c3.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/fonts/flag-icon-css/flag-icon.min.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/multi-select/css/multi-select.css") }}">
    {{----}}
</head>
<body>
    <div id="app">
        @section('header')
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <div class="row">
                        <div class="col-md-2">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img id="logo" src="{{ @asset("storage/app/" . element('logo')) }}" alt="">
                                    </div>
                                    <div class="col-md-7">
                                        <h3 id="title">
                                            {{--{{ config('app.name', 'Laravel') }}--}}
                                            {{--{{ 'Shop' }}--}}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div id="full-title" align="center">
                                <div class="row">
                                    <h4 align="center" class="center">{{ element('title') }}</h4>
                                </div>
                                <div class="row">
                                    <h4 align="center">{{ element('long-title') }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img id="logo" src="{{ @asset("storage/app/" . element('logo')) }}" alt="">
                                    </div>
                                    <div class="col-md-7">
                                        <h3 id="title">
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{--<!-- Collapsed Hamburger -->--}}
                    {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">--}}
                        {{--<span class="sr-only">Toggle Navigation</span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                    {{--</button>--}}


                    <!-- Branding Image -->
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    {{--<ul class="nav navbar-nav navbar-right">--}}
                        {{--<!-- Authentication Links -->--}}
                        {{--@if (Auth::guest())--}}
                            {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
                            {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                        {{--@else--}}
                            {{--<li class="dropdown">--}}
                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                                    {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                                {{--</a>--}}

                                {{--<ul class="dropdown-menu" role="menu">--}}
                                    {{--<li>--}}
                                        {{--<a href="{{ route('logout') }}"--}}
                                            {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                            {{--Logout--}}
                                        {{--</a>--}}

                                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                            {{--{{ csrf_field() }}--}}
                                        {{--</form>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--@endif--}}
                    {{--</ul>--}}
                </div>
            </div>
        </nav>
        @show


        @section('navbar')
                <nav class="navbar navbar-default navbar-panel">
                    <div class="container">
                        <div class="navbar-header">

                            <div class="row">
                                <div class="col-md-10">
                                    <ul class="navbar-items">
                                        <a href="{{ route('poster') }}">
                                            <li class="navbar-item">
                                                <div align="center">Афиши</div>
                                            </li>
                                        </a>
                                        <a href="{{ route('tracks') }}">
                                            <li class="navbar-item">
                                                <div align="center">Треки</div>
                                            </li>
                                        </a>
                                        <a href="{{ route('clips') }}">
                                            <li class="navbar-item">
                                                <div align="center">Видеоклипы</div>
                                            </li>
                                        </a>
                                        <a href="{{ route('contacts') }}">
                                            <li class="navbar-item">
                                                <div align="center">Соцсети</div>
                                            </li>
                                        </a>
                                    </ul>
                                </div>
                                <div class="col-md-2">
                                    <a class="" href="{{ url('/') }}">
                                        <img id="korzina-img" src="{{ @asset("storage/app/korzina.png") }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            @show

        @yield('content')

        @section('footer')
            <footer class="navbar navbar-default" id="footer">
                    <div class="container">
                        <div class="navbar-header">
                            <div class="row">
                                <div class="col-md-2">
                                    <a class="navbar-brand" href="{{ url('/') }}">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img id="logo" src="{{ @asset("storage/app/" . element('logo')) }}" alt="">
                                            </div>
                                            <div class="col-md-7">
                                                <h3 id="title">
                                                </h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div id="footer-contact-data">
                                        <div class="row">
                                            <h4 align="center">Контактный телефон</h4>
                                        </div>
                                        <div class="row">
                                            <h4 align="center">{{ element('contact-phone') }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a class="navbar-brand" href="{{ url('/') }}">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img id="logo" src="{{ @asset("storage/app/" . element('logo')) }}" alt="">
                                            </div>
                                            <div class="col-md-7">
                                                <h3 id="title">
                                                </h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            </footer>
        @show
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
