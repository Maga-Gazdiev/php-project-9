<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token">
    <title>Анализатор страниц</title>
</head>
<body>
    <header class="flex-shrink-0">
        <div class="navbar navbar-expand-md navbar-dark bg-dark px-3">
            <a class="navbar-brand" href="{{ route('/home')}}">Анализатор страниц</a>
            <div class="navbar-nav">
                <a class="nav-link {{ request()->routeIs('/home') ? 'active' : '' }}" href="{{ route('/home') }}">Главная</a>
            </div>
            <div class="navbar-nav">
                <a class="nav-link {{ request()->routeIs('urls.index') ? 'active' : '' }}" href="{{ route('urls.index') }}">Сайты</a>
            </div>
        </div>
    </header>

    @yield('new_content')
</body>


