<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plano de Mercado</title>
    <link rel="stylesheet" href="{{ asset('css/plano.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Planos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Men&uacute;</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Bienvenido
                                {{ Session::get('usuario') }}</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}"><i
                                    class="bi bi-speedometer"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('clientes') }}"><i
                                    class="bi bi-people-fill"></i> Clientes</a>
                            @if (Session::get('rol') == 1)
                                <a class="nav-link active" aria-current="page" href="{{ route('usuarios') }}"><i
                                        class="bi bi-people-fill"></i> Usuarios</a>
                                <a class="nav-link active" aria-current="page" href="{{ route('viewTienda') }}"><i
                                        class="bi bi-clipboard-data-fill"></i> Reporte Tiendas</a>
                                <a class="nav-link active" aria-current="page" href="{{ route('viewVentas') }}"><i
                                        class="bi bi-graph-up-arrow"></i> Reporte Venta/Reserva</a>
                                <a class="nav-link active" aria-current="page" href="{{ route('viewVentasR') }}"><i
                                        class="bi bi-bar-chart-fill"></i> Reporte Grafico Ventas</a>
                                <a class="nav-link active" aria-current="page" href="{{ route('viewVentaAll') }}"><i
                                        class="bi bi-bar-chart-fill"></i> Reporte Ventas</a>
                            @endif
                            <a class="nav-link active" aria-current="page" href="{{ route('logout') }}"><i
                                    class="bi bi-box-arrow-left"></i> Cerar
                                Sesi&oacute;n</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>

</html>
