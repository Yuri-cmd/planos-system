@extends('layout')
@section('content')
    <style>
        .dataTables_wrapper .dt-buttons {
            float: left;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: left;
        }

        .dataTables_wrapper .dataTables_paginate {
            text-align: center;
        }

        .paging_simple_numbers {
            display: flex;
            justify-content: center;
        }

        .buttons-excel {
            background-color: #4CAF50 !important;
            border: none !important;
            color: white !important;
            padding: 10px 24px !important;
            text-align: center !important;
            text-decoration: none !important;
            display: inline-block !important;
            font-size: 16px !important;
            margin: 4px 2px !important;
            cursor: pointer !important;
            border-radius: 5px !important;
        }
    </style>
    <div class="contenedor-almacen" style="margin-top: 100px; padding: 10px;">
        <div class="page-title-box">
            <div class="col-md-4">
                <h6 class="page-title">Tiendas</h6>
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
                        <h4 class="card-title">Lista de Tiendas</h4>
                    </div>

                </div>
                <div class="card-body" style="height: auto">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Tienda</th>
                                <th class="text-center">Empresa/Socio</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $r)
                                <tr>
                                    <th>{{ $r->id_tienda }}</th>
                                    <td>{{ $r->tienda }}</td>
                                    <td>{{ $r->nombre_cargo }}</td>
                                    <td>{{ $r->descripcion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script>
        let token = "{{ csrf_token() }}";
        $('#example').DataTable({
            dom: 'Bfrtip', // Define dónde aparecerán los botones
            buttons: [{
                extend: 'excelHtml5',
                title: `Reporte de tiendas ${obtenerFechaFormateada()}`,
                text: 'Excel',
                className: 'btn btn-primary'
            }],
        });

        function obtenerFechaFormateada() {
            // Crear una nueva fecha
            const fecha = new Date();

            // Obtener las partes de la fecha
            const dia = fecha.getDate();
            const mes = fecha.toLocaleString('es-ES', {
                month: 'short'
            });
            const año = fecha.getFullYear();

            // Construir la fecha en el formato deseado
            const fechaFormateada = `${dia} de ${mes} ${año}`;

            return fechaFormateada;
        }
    </script>
@endsection
