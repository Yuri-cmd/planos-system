@extends('layout')
@section('content')
    <div class="contenedor-almacen" style="margin-top: 100px; padding: 10px;">
        <div class="page-title-box">
            <div class="col-md-4">
                <h6 class="page-title">Usuarios</h6>
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
                        <h4 class="card-title">Lista de Usuarios</h4>
                    </div>
                    <div>
                        <button data-bs-toggle="modal" data-bs-target="#addClienteModal" class="btn btn-primary"
                            style="background-color: #626ed4; border-color: #626ed4;"><i class="bi bi-plus-lg"></i>
                            Agregar
                            Usuario
                        </button>
                        <button class="btn btn-danger btnBorrar"><i class="bi bi-trash-fill"></i> Borrar</button>
                    </div>
                </div>
                <div class="card-body" style="height: auto">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Rol</th>
                                <th class="text-center">Estado</th>
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
                    <h5 class="modal-title" id="addClienteModalLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioPersona">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="clave" class="form-label">Clave</label>
                            <input type="password" class="form-control" id="clave" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select name="rol" id="rol" class="form-control">
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                                @endforeach
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
                            <label for="nombreEdit" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombreEdit" name="nombreEdit" required>
                        </div>

                        <div class="mb-3">
                            <label for="usuarioEdit" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuarioEdit" required>
                        </div>
                        <div class="mb-3">
                            <label for="claveEdit" class="form-label">Clave</label>
                            <input type="password" class="form-control" id="claveEdit" required>
                        </div>
                        <div class="mb-3">
                            <label for="rolEdit" class="form-label">Rol</label>
                            <select name="rol" id="rolEdit" class="form-control">
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estadoEdit" class="form-label">Estado</label>
                            <select id="estadoEdit" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
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

    <script>
        let token = "{{ csrf_token() }}";
        let tabla = $('#example').DataTable({
            "ajax": {
                "url": "{{ route('getUsuarios') }}",
                "dataSrc": ""
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "usuario"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "rol",
                    "render": function(data, type, row) {
                        return data.rol; // Asumiendo que 'rol' es un objeto con propiedad 'rol'
                    }
                },
                {
                    "data": "estado",
                    "render": function(data, type, row) {
                        return row.estado == "1" ? 'Activo' : 'Inactivo';
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `<button data-item="${row.id}" class="btn-edt btn btn-sm btn-info" style="color:white;"><i class="bi bi-pencil-square"></i></button>`;
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `<input type="checkbox" data-id="${row.id}" class="btnCheckEliminar">`;
                    }
                }
            ]
        });


        $("#guardarPersona").click(function() {
            // Validar que todos los campos estén llenos
            if ($("#formularioPersona")[0].checkValidity()) {
                // Obtener los valores de los campos
                var usuario = $("#usuario").val();
                var clave = $("#clave").val();
                var nombre = $("#nombre").val();
                var rol = $("#rol").val();

                $.ajax({
                    url: '{{ route('saveUsuario') }}',
                    method: 'POST',
                    data: {
                        _token: token,
                        nombre: nombre,
                        usuario: usuario,
                        clave: clave,
                        rol: rol,
                    },
                    success: function(response) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Se guardo correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        tabla.ajax.reload();
                    },
                    error: function(error) {
                        console.error(error);
                        // Aquí puedes manejar los errores
                    }
                });
                // Cerrar el modal después de guardar
                $("#addClienteModal").modal("hide");
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
                            url: "{{ route('deleteUsuario') }}",
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
            $('#nombreEdit').val(data.nombre);
            $('#usuarioEdit').val(data.usuario);
            $('#claveEdit').val(data.clave);
            $('#rolEdit').val(data.rol.id);
            $('#estadoEdit').val(data.estado);
            // Mostrar el modal de edición
            $('#editarClienteModal').modal('show');
        });

        $('#guardarCambios').click(function() {
            // Aquí puedes realizar la lógica para guardar los cambios mediante AJAX
            let clienteId = $('#clienteId').val();
            let nombre = $('#nombreEdit').val();
            let usuario = $('#usuarioEdit').val();
            let clave = $('#claveEdit').val();
            let rol = $('#rolEdit').val();
            let estado = $('#estadoEdit').val();

            // Objeto con los datos a enviar
            let datosCliente = {
                _token: token,
                id: clienteId,
                nombre: nombre,
                usuario: usuario,
                clave: clave,
                rol: rol,
                estado: estado
            };

            // Ejemplo de solicitud AJAX para guardar los cambios (adaptar según tu aplicación)
            $.ajax({
                url: '{{ route('actualizarUsuario') }}', // Ruta de tu controlador para actualizar cliente
                method: 'POST',
                data: datosCliente,
                success: function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Se guardo correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    tabla.ajax.reload();
                    $('#editarClienteModal').modal('hide');
                },
                error: function(error) {
                    console.error(error);
                    // Aquí puedes manejar los errores
                }
            });
        });
    </script>
@endsection
