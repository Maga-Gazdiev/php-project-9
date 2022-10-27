<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-lt-installed="true">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token">
    <title>Анализатор страниц</title>
</head>
<body class="min-vh-100 d-flex flex-column">
<header class="flex-shrink-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="{{ route('main') }}">Анализатор страниц</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('main') ? 'active' : '' }}" href="{{ route('main') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('urls.index') ? 'active' : '' }}"
                       href="{{ route('urls.index') }}">Сайты</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main class="flex-grow-1">
    @include('flash::message')
    <div class="container-lg">
        @yield('content')
    </div>
</main>

</body>
</html>
