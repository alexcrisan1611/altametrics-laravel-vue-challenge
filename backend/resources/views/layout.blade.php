<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', env('APP_NAME'))</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-white dark:bg-gray-900">
    <header>
        <nav>
        </nav>
    </header>

    <main class="px-16 py-4">
        @yield('content')
    </main>

    <footer>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
