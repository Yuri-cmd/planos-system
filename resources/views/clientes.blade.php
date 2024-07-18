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
                <h6 class="page-title">Clientes</h6>
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
                        <h4 class="card-title">Lista de Clientes</h4>
                    </div>
                    <div>
                        <button data-bs-toggle="modal" data-bs-target="#addClienteModal" class="btn btn-primary"
                            style="background-color: #626ed4; border-color: #626ed4;"><i class="bi bi-plus-lg"></i>
                            Agregar
                            Usuario
                        </button>
                        @if (Session::get('rol') == 1)
                            <button class="btn btn-danger btnBorrar"><i class="bi bi-trash-fill"></i> Borrar</button>
                        @endif
                    </div>
                </div>
                <div class="card-body" style="height: auto">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Nombre y Apellidos</th>
                                <th class="text-center">DNI</th>
                                <th class="text-center">Número de telefono</th>
                                <th class="text-center">Lugar de visita</th>
                                <th class="text-center">Rubro del puesto</th>
                                <th class="text-center">Tipo de venta</th>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Eliminar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addClienteModal" tabindex="-1" aria-labelledby="addClienteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClienteModalLabel">Agregar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioPersona">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre y Apellidos</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="number" class="form-control" id="dni" maxlength="8" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Número de celular o telefono</label>
                            <input type="phone" class="form-control" id="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="visita" class="form-label">Lugar de visita</label>
                            <input type="text" class="form-control" id="visita" required>
                        </div>
                        <div class="mb-3">
                            <label for="rubro" class="form-label">Rubro del puesto interesado</label>
                            <input type="text" class="form-control" id="rubro" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipoVenta" class="form-label">Tipo de venta</label>
                            <select name="tipoVenta" id="tipoVenta" class="form-control">
                                <option value="contado">Contado</option>
                                <option value="finanaciado">Finanaciado</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardarPersona">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar cliente -->
    <div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="editarClienteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarClienteModalLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioEditarCliente">
                        <input type="hidden" id="clienteId" name="clienteId">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre y Apellidos</label>
                            <input type="text" class="form-control" id="nombreE" required>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="number" class="form-control" id="dniE" maxlength="8" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Número de celular o telefono</label>
                            <input type="phone" class="form-control" id="telefonoE" required>
                        </div>
                        <div class="mb-3">
                            <label for="visita" class="form-label">Lugar de visita</label>
                            <input type="text" class="form-control" id="visitaE" required>
                        </div>
                        <div class="mb-3">
                            <label for="rubro" class="form-label">Rubro del puesto interesado</label>
                            <input type="text" class="form-control" id="rubroE" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipoVenta" class="form-label">Tipo de venta</label>
                            <select name="tipoVenta" id="tipoVentaE" class="form-control">
                                <option value="contado">Contado</option>
                                <option value="finanaciado">Finanaciado</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardarCambios">Guardar Cambios</button>
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
        let tabla = $('#example').DataTable({   
            "ajax": {
                "url": "{{ route('getClientes') }}",
                "dataSrc": ""
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "dni"
                },
                {
                    "data": "telefono"
                },
                {
                    "data": "visita"
                },
                {
                    "data": "rubro"
                },
                {
                    "data": "tipoVenta"
                },
                {
                    "data": "nombreUser"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return formatDate(row.creado_el);
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        if (row && row.id) {
                            return `<button data-item="${row.id}" class="{{ Session::get('rol') == 1 ? 'btn-edt' : '' }} btn btn-sm btn-info" style="color:white;"><i class="bi bi-pencil-square"></i></button>`;
                        }
                        return '';
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        if (row && row.id) {
                            return `<input type="checkbox" data-id="${row.id}" class="btnCheckEliminar">`;
                        }
                        return '';
                    }
                }
            ],
            @if (Session::get('rol') == 1)
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: `Reporte de clientes`,
                    text: 'Excel',
                    className: 'btn btn-primary'
                }],
            @endif
        });



        $("#guardarPersona").click(function() {
            // Validar que todos los campos estén llenos
            if ($("#formularioPersona")[0].checkValidity()) {
                // Obtener los valores de los campos
                let nombre = $("#nombre").val();
                let dni = $("#dni").val();
                let telefono = $("#telefono").val();
                let visita = $("#visita").val();
                let rubro = $("#rubro").val();
                let tipoVenta = $("#tipoVenta").val();

                $.ajax({
                    url: '{{ route('saveCliente') }}',
                    method: 'POST',
                    data: {
                        _token: token,
                        nombre: nombre,
                        dni: dni,
                        telefono: telefono,
                        visita: visita,
                        rubro: rubro,
                        tipoVenta: tipoVenta,
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: response.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#addClienteModal").modal("hide");
                            tabla.ajax.reload();
                            $("#formularioPersona")[0].reset();
                        } else {
                            Swal.fire({
                                title: "Info",
                                text: response.mensaje,
                                icon: "info"
                            });
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        // Aquí puedes manejar los errores
                    }
                });
                // Cerrar el modal después de guardar

            } else {
                // Mostrar mensaje de error o manejar la validación de otra manera
                Swal.fire({
                    title: "Info",
                    text: "Todos los campos son requeridos",
                    icon: "info"
                });
            }
        });

        $('.btnBorrar').on('click', function() {
            let ids = [];

            // Recorre todos los checkboxes seleccionados
            $('.btnCheckEliminar:checked').each(function() {
                ids.push($(this).data('id'));
            });

            if (ids.length > 0) {
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('deleteCliente') }}",
                            method: 'POST',
                            data: {
                                _token: token,
                                ids: ids
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Eliminado!",
                                    text: "Eliminado correctamente",
                                    icon: "success"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        tabla.ajax.reload();
                                    }
                                });
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: "Info",
                    text: "Selecciona al menos un elemento para eliminar.",
                    icon: "info"
                });
            }
        });

        $('#example').on('click', '.btn-edt', function() {
            // Obtener los datos de la fila seleccionada (suponiendo que usas DataTables)
            let data = tabla.row($(this).closest('tr')).data();
            // Mostrar los datos en el modal de edición
            $('#clienteId').val(data.id); // Asignar el ID del cliente al campo oculto
            $('#nombreE').val(data.nombre);
            $('#dniE').val(data.dni);
            $('#telefonoE').val(data.telefono);
            $('#visitaE').val(data.visita);
            $('#rubroE').val(data.rubro);
            $('#tipoVentaE').val(data.tipoVenta);
            // Mostrar el modal de edición
            $('#editarClienteModal').modal('show');
        });

        $('#guardarCambios').click(function() {
            // Aquí puedes realizar la lógica para guardar los cambios mediante AJAX
            let clienteId = $('#clienteId').val();
            let nombre = $("#nombreE").val();
            let dni = $("#dniE").val();
            let telefono = $("#telefonoE").val();
            let visita = $("#visitaE").val();
            let rubro = $("#rubroE").val();
            let tipoVenta = $("#tipoVentaE").val();

            // Objeto con los datos a enviar
            let datosCliente = {
                _token: token,
                id: clienteId,
                nombre: nombre,
                dni: dni,
                telefono: telefono,
                visita: visita,
                rubro: rubro,
                tipoVenta: tipoVenta,
            };

            // Ejemplo de solicitud AJAX para guardar los cambios (adaptar según tu aplicación)
            $.ajax({
                url: '{{ route('actualizarCliente') }}', // Ruta de tu controlador para actualizar cliente
                method: 'POST',
                data: datosCliente,
                success: function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.mensaje,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#editarClienteModal').modal('hide');
                    tabla.ajax.reload();
                },
                error: function(error) {
                    console.error(error);
                    // Aquí puedes manejar los errores
                }
            });
        });

        function formatDate(dateString) {
            // Crear un objeto Date desde la cadena de fecha
            const date = new Date(dateString);

            // Extraer las partes individuales de la fecha
            const day = String(date.getDate()).padStart(2, '0'); // Día del mes (con dos dígitos)
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Mes (con dos dígitos, de 0-11, por eso se suma 1)
            const year = date.getFullYear(); // Año

            // Extraer las partes individuales de la hora
            let hours = date.getHours(); // Hora (de 0-23)
            const minutes = String(date.getMinutes()).padStart(2, '0'); // Minutos (con dos dígitos)

            // Determinar si es AM o PM
            const ampm = hours >= 12 ? 'pm' : 'am';

            // Convertir la hora al formato de 12 horas
            hours = hours % 12;
            hours = hours ? hours : 12; // La hora '0' debe ser '12'
            const formattedHours = String(hours).padStart(2, '0'); // Asegurarse de que la hora tenga dos dígitos

            // Combinar las partes formateadas en el formato deseado
            const formattedDate = `${day}/${month}/${year} ${formattedHours}:${minutes}${ampm}`;

            return formattedDate;
        }
    </script>
@endsection
