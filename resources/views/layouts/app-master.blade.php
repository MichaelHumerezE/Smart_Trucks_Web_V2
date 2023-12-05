<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Smart-Trucks</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" />

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    @yield('css')

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

</head>

<body class="dark">
    <div id="app" class="wrapper">
        @include('layouts.sidebar')
        <div id="content">
            @include('layouts.partials.navbar')
            <main class="container">
                @include('components.flash_alerts')
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('js')
    <script>
        const temaOscuro = () => {
            document.querySelector("body").setAttribute("data-bs-theme", "dark");
            document.querySelector("#dl-icon").setAttribute("class", "fa fa-sun");
        }
        const temaClaro = () => {
            document.querySelector("body").setAttribute("data-bs-theme", "light");
            document.querySelector("#dl-icon").setAttribute("class", "fa fa-moon");
        }
        const cambiarTema = () => {
            document.querySelector("body").getAttribute("data-bs-theme") === "light"?
            temaOscuro() : temaClaro();
        }
    </script>
</body>

</html>
