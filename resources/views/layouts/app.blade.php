<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('resources/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
    @yield('page-specific-css')
</head>

<body>

    @include('layouts.sidebar')

    <div class="main-content" id="mainContentArea">

        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')
    </div>

    <script src="{{ asset('resources/js/jquery3-5-1.min.js') }}"></script>
    <script src="{{ asset('resources/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('resources/js/main.js') }}"></script>
    @yield('custom-js-page')
</body>

</html>