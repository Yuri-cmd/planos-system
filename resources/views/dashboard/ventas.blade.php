@extends('layout')
@section('content')
    <div class="contenedor-almacen" style="margin-top: 100px; padding: 10px;">
        <div class="page-title-box">
            <div class="col-md-4">
                <h6 class="page-title">Ventas</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"
                            style="text-decoration: none; color: black;"></a></li>
                </ol>
            </div>
        </div>
        <div class="mt-10">
            <div class="card" style="width: 100%">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Lista de Ventas</h4>
                    </div>
                    <!-- Campos de filtro -->
                    <div style="width: fit-content">
                        <form id="filtros-form" method="GET" action="{{ route('viewVentas') }}">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="daterange" class="form-control" />
                                </div>

                                <div class="col-3">
                                    <select name="tipo" class="form-control" style="fit-content;">
                                        {{-- <option value="todos">Todos</option> --}}
                                        <option value="tipoPago" {{ $tipo == 'tipoPago' ? 'selected' : '' }}>Tipo Pago
                                        </option>
                                        <option value="contado" {{ $tipo == 'contado' ? 'selected' : '' }}>Contado</option>
                                        <option value="credito" {{ $tipo == 'credito' ? 'selected' : '' }}>Credito</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                                <input type="hidden" name="fecha_inicio" value="{{ $fecha_inicio ?? '' }}">
                                <input type="hidden" name="fecha_fin" value="{{ $fecha_fin ?? '' }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body" style="display: flex;display: flex;justify-content: center; height: 75vh;">
                    <canvas id="barHorizontal" style="height: 50vh"></canvas>
                </div>
            </div>
        </div>
    </div>
    <style>
        #barHorizontal {
            height: 100% !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.0/chart.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            const fechaInicio = "{{ $fecha_inicio ?? '' }}";
            const fechaFin = "{{ $fecha_fin ?? '' }}";

            $('input[name="daterange"]').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: fechaInicio ? fechaInicio : moment().subtract(29, 'days').format('YYYY-MM-DD'),
                endDate: fechaFin ? fechaFin : moment().format('YYYY-MM-DD')
            }, function(start, end, label) {
                // Al seleccionar un rango de fechas, actualiza los inputs ocultos
                $('input[name="fecha_inicio"]').val(start.format('YYYY-MM-DD'));
                $('input[name="fecha_fin"]').val(end.format('YYYY-MM-DD'));
            });

            // Inicializa los inputs ocultos
            $('input[name="fecha_inicio"]').val(fechaInicio);
            $('input[name="fecha_fin"]').val(fechaFin);
        });

        let token = "{{ csrf_token() }}";
        const ctxHorizontal = document.getElementById('barHorizontal').getContext('2d');
        const barHorizontal = new Chart(ctxHorizontal, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                        label: 'Tipo Pago',
                        data: [],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Contado',
                        data: [],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Credito',
                        data: [],
                        backgroundColor: 'rgba(130, 224, 170, 0.2)',
                        borderColor: 'rgba(130, 224, 170, 1)',
                        borderWidth: 1
                    }
                ],
            },
            options: {
                indexAxis: 'x',
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // JavaScript para manejar la actualización de datos según los filtros
        $('#filtros-form').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: "{{ route('viewVentasR') }}",
                type: 'GET',
                data: formData,
                success: function(response) {
                    // Actualiza el gráfico con los nuevos datos
                    barHorizontal.data.labels = response.labels;

                    if (response.tipo == 'todos') {
                        barHorizontal.data.datasets[0].data = response.total_tipoPago;
                        barHorizontal.data.datasets[1].data = response.total_contado;
                        barHorizontal.data.datasets[2].data = response.total_credito;
                        barHorizontal.data.datasets[0].hidden = false;
                        barHorizontal.data.datasets[1].hidden = false;
                        barHorizontal.data.datasets[2].hidden = false;
                    } else if (response.tipo == 'tipoPago') {
                        barHorizontal.data.datasets[0].data = response.total_tipoPago;
                        barHorizontal.data.datasets[1].data = [];
                        barHorizontal.data.datasets[2].data = [];
                        barHorizontal.data.datasets[0].hidden = false;
                        barHorizontal.data.datasets[1].hidden = true;
                        barHorizontal.data.datasets[2].hidden = true;
                    } else if (response.tipo == 'contado') {
                        barHorizontal.data.datasets[0].data = [];
                        barHorizontal.data.datasets[1].data = response.total_contado;
                        barHorizontal.data.datasets[2].data = [];
                        barHorizontal.data.datasets[0].hidden = true;
                        barHorizontal.data.datasets[1].hidden = false;
                        barHorizontal.data.datasets[2].hidden = true;
                    } else if (response.tipo == 'credito') {
                        barHorizontal.data.datasets[0].data = [];
                        barHorizontal.data.datasets[1].data = [];
                        barHorizontal.data.datasets[2].data = response.total_credito;
                        barHorizontal.data.datasets[0].hidden = true;
                        barHorizontal.data.datasets[1].hidden = true;
                        barHorizontal.data.datasets[2].hidden = false;
                    }

                    barHorizontal.update();
                }
            });
        });
    </script>
@endsection
