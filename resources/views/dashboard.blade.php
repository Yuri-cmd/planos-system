@extends('layout')
@section('content')
    <div style="margin-top: 70px; padding: 10px; display: flex; align-items: center;">
        <div>
            <span id="zona">Ir al sotano</span>
        </div>
        <div class="switch-container">
            <input type="checkbox" id="switch" class="switch-input">
            <label for="switch" class="switch-label"></label>
        </div>
    </div>

    <div class="piso">
        <div class="plano">
            <div class="section">
                @foreach ($seccion1 as $item)
                    <div class="grid-item">
                        <h5>{{ ucwords(strtolower($item['nombre'])) }}</h5>
                        <div class="sub-grid"
                            style="grid-template-columns: repeat({{ $item['cantidad_tiendas'] / 2 }}, 1fr);">
                            @foreach ($item['tiendas'] as $i => $tienda)
                                <div class="sub-grid-item addComprador" data-estado="{{ $tienda['estado'] }}"
                                    data-id="{{ $tienda['id'] }}" data-cargo="{{ $tienda['nombreCargo'] }}"
                                    style="{{ color($tienda['estado']) }}"
                                    data-tienda="{{ ucwords(strtolower($item['nombre'])) }}"
                                    data-numero="{{ $tienda['numeracion'] }}">
                                    <div style="width: 25px; border: 1px solid black; border-radius: 50%;">
                                        {{ $tienda['numeracion'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="middle-section">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="middle-item">
                    </div>
                @endfor
            </div>
            <div class="section">
                @php
                    $redBoxCounter = 1;
                @endphp
                @foreach ($seccion2 as $item)
                    <div class="grid-item diff">
                        <h5>{{ ucwords(strtolower($item['nombre'])) }}</h5>
                        <div class="sub-grid">
                            @foreach ($item['tiendas'] as $i => $tienda)
                                @php
                                    $subGridClass = '';
                                    $numero = 0;
                                    if ($tienda['id'] == 559) {
                                        $subGridClass = 'red-box1';
                                    }
                                    if ($tienda['id'] == 560) {
                                        $subGridClass = 'red-box2';
                                        $numero = 11;
                                    }
                                @endphp
                                <div class="sub-grid-item addComprador {{ $subGridClass }}"
                                    data-estado="{{ $tienda['estado'] }}" data-id="{{ $tienda['id'] }}"
                                    data-cargo="{{ $tienda['nombreCargo'] }}" style="{{ color($tienda['estado']) }}"
                                    data-tienda="{{ ucwords(strtolower($item['nombre'])) }}"
                                    data-numero="{{ $tienda['numeracion'] }}">
                                    <div style="width: 25px; border: 1px solid black; border-radius: 50%;">
                                        {{ $tienda['numeracion'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="middle-section">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="middle-item">
                    </div>
                @endfor
            </div>
            <div class="section-vertical">
                @foreach ($seccion4 as $item)
                    <div class="grid-item">
                        <h5>{{ ucwords(strtolower($item['nombre'])) }}</h5>
                        <div class="sub-grid" style="grid-template-columns: repeat({{ $item['cantidad_tiendas'] }}, 1fr);">
                            @foreach ($item['tiendas'] as $i => $tienda)
                                <div class="sub-grid-item addComprador" data-estado="{{ $tienda['estado'] }}"
                                    data-id="{{ $tienda['id'] }}" data-cargo="{{ $tienda['nombreCargo'] }}"
                                    data-tienda="{{ ucwords(strtolower($item['nombre'])) }}"
                                    data-numero="{{ $tienda['numeracion'] }}"
                                    style="display: flex; justify-content: center;{{ color($tienda['estado']) }}">
                                    <div style="width: 25px; border: 1px solid black; border-radius: 50%;">
                                        {{ $tienda['numeracion'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="plano" style="margin-top: 50px;">
            <div class="section-horizontal">
                @foreach ($seccion3 as $item)
                    <div class="grid-item-horizontal">
                        <h5>{{ ucwords(strtolower($item['nombre'])) }}</h5>
                        <div class="sub-grid-horizontal"
                            style="grid-template-columns: repeat({{ $item['cantidad_tiendas'] }}, 1fr);">
                            @foreach ($item['tiendas'] as $i => $tienda)
                                <div class="sub-grid-item-horizontal addComprador" data-estado="{{ $tienda['estado'] }}"
                                    data-id="{{ $tienda['id'] }}" data-cargo="{{ $tienda['nombreCargo'] }}"
                                    style="display: flex; justify-content: center;{{ color($tienda['estado']) }}"
                                    data-tienda="{{ ucwords(strtolower($item['nombre'])) }}"
                                    data-numero="{{ $tienda['numeracion'] }}">
                                    <div style="width: 15px; font-size: 12px; border: 1px solid black; border-radius: 50%;">
                                        {{ $tienda['numeracion'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="leyenda">
            <div class="fila">
                <div class="content-item">
                    <div class="color" style="background-color: pink;"></div>
                    <div class="texto"><span>B - FRUTA</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: #e9bd15;"></div>
                    <div class="texto"><span>B - LIMON TOMATE</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: blue;"></div>
                    <div class="texto"><span>B - CEBOLLA AJOS</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: green;"></div>
                    <div class="texto"><span>B - ZANAHORIA CHOCLO</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: gray;"></div>
                    <div class="texto"><span>B - PAPA</span></div>
                </div>
            </div>
            <div class="fila">
                <div class="content-item">
                    <div class="color" style="background-color: #ff00ff;"></div>
                    <div class="texto"><span>A - HUEVOS</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: green;"></div>
                    <div class="texto"><span>A - GRANOS</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: blue;"></div>
                    <div class="texto"><span>A - ABARROTES</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: orange;"></div>
                    <div class="texto"><span>A - ESP SECA</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: #e9bd15;"></div>
                    <div class="texto"><span>A - DESCARTABLE</span></div>
                </div>
            </div>
            <div class="fila">
                <div class="content-item">
                    <div class="color" style="background-color: blue;"></div>
                    <div class="texto"><span>ROPA</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: green;"></div>
                    <div class="texto"><span>AGROPECUARIOS</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: pink;"></div>
                    <div class="texto"><span>SALON DE BELLEZA</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: blue;"></div>
                    <div class="texto"><span>ELECTRONICO</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: purple;"></div>
                    <div class="texto"><span>FERRETERIA</span></div>
                </div>
            </div>
            <div class="fila">
                <div class="content-item">
                    <div class="color" style="background-color: green;"></div>
                    <div class="texto"><span>lOCAL DE COMIDA</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: orange;"></div>
                    <div class="texto"><span>lOCAL DE ARTESANIA</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: blue;"></div>
                    <div class="texto"><span>lOCAL DE JUGUERIA</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: #e9bd15;"></div>
                    <div class="texto"><span>LICORERIA</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: orange;"></div>
                    <div class="texto"><span>GOLOSINAS</span></div>
                </div>
            </div>
            <div class="fila">
                <div class="content-item">
                    <div class="color" style="background-color: yellow;"></div>
                    <div class="texto"><span>B - VERDURAS ZAPALLO</span></div>
                </div>
                <div class="content-item">
                    <div class="color"></div>
                    <div class="texto"><span></span></div>
                </div>
                <div class="content-item">
                    <div class="color"></div>
                    <div class="texto"><span></span></div>
                </div>
                <div class="content-item">
                    <div class="color"></div>
                    <div class="texto"><span></span></div>
                </div>
                <div class="content-item">
                    <div class="color"></div>
                    <div class="texto"><span></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="sotano" style="display: none; width: fit-content;">
        <div class="plano" style="width: 100%">
            <div class="section"
                style="grid-template-columns: repeat(4, 1fr); grid-template-rows: repeat(5, 1fr); gap: 10px;">
                @foreach ($seccion5 as $item)
                    <div class="grid-item-s">
                        <h5>{{ ucwords(strtolower($item['nombre'])) }}</h5>
                        @php
                            $rows = 8;
                            if ($item['cantidad_tiendas'] == 18) {
                                $rows = 9;
                            }
                            if ($item['cantidad_tiendas'] == 14) {
                                $rows = 7;
                            }
                        @endphp
                        <div class="sub-grid" style="grid-template-columns: repeat({{ $rows }}, 1fr);">
                            @foreach ($item['tiendas'] as $tienda)
                                <div class="sub-grid-item addComprador" data-estado="{{ $tienda['estado'] }}"
                                    data-id="{{ $tienda['id'] }}" data-cargo="{{ $tienda['nombreCargo'] }}"
                                    data-tienda="{{ ucwords(strtolower($item['nombre'])) }}"
                                    data-numero="{{ $tienda['numeracion'] }}"
                                    style="{{ color($tienda['estado']) }}; display: {{ $tienda['id'] == 1076 || $tienda['id'] == 1077 ? 'none' : '' }}">
                                    <div style="width: 25px; border: 1px solid black; border-radius: 50%;">
                                        {{ $tienda['numeracion'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="leyenda">
            <div class="fila" style="flex-direction: row; justify-content: space-evenly;">
                <div class="content-item">
                    <div class="color" style="background-color: pink;"></div>
                    <div class="texto"><span>D - CARNE</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: #e9bd15;"></div>
                    <div class="texto"><span>D- AVES</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: blue;"></div>
                    <div class="texto"><span>D- TRUCHA - PESCADO</span></div>
                </div>
                <div class="content-item">
                    <div class="color" style="background-color: green;"></div>
                    <div class="texto"><span>D- EMBUTIDOS</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="vendedorAdd" tabindex="-1" aria-labelledby="vendedorAddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="vendedorAddLabel">Reserva</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formComprador">
                        <input type="text" class="form-control" id="id"
                            value="{{ Session::get('usuario_id') }}" hidden>
                        <input type="text" class="form-control" id="idtienda" value="" hidden>
                        <div class="mb-3">
                            <label for="asesor" class="form-label">Asesor</label>
                            <input type="text" class="form-control" id="asesor"
                                value="{{ Session::get('usuario') }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="cargo" class="form-label" id="tipoCargo">Empresa o Socio</label>
                            <input type="text" class="form-control" id="cargo" value="" readonly>
                        </div>
                        <hr>
                        <p>Datos Cliente:</p>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombres y Apellidos</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI – RUC </label>
                            <input type="text" class="form-control" id="dni" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Direcci&oacute;n</label>
                            <input type="text" class="form-control" id="direccion" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Celular</label>
                            <input type="phone" class="form-control" id="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="ocupacion" class="form-label">Ocupaci&oacute;n</label>
                            <input type="text" class="form-control" id="ocupacion" required>
                        </div>
                        <div class="mb-3">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="bumber" class="form-control" id="monto" required>
                        </div>
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Descripcion</label>
                            <textarea class="form-control" id="comentario" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-warning" id="regresar"
                        style="display: none;">Regresar</button>
                    <button type="button" id="saveComprador" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateColor" tabindex="-1" aria-labelledby="updateColorLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateColorLabel">Asignar Estado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formColor">
                        <input type="text" class="form-control" id="idtiendaU" value="" hidden>
                        <input type="text" class="form-control" id="cargoC" value="" hidden>
                        <div class="mb-3">
                            <label for="estadoTienda" class="form-label">Tipo</label>
                            <select type="text" class="form-control" id="estado">

                            </select>
                        </div>
                        <div class="nombre_cargo" style="display: none;">
                            <div class="mb-3">
                                <label for="nombre_cargo" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombreCargo" value="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="saveColor">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCompraTiendaModal" tabindex="-1" aria-labelledby="addCompraTiendaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCompraTiendaModalLabel">Detalle de Venta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formVenta">
                        <input type="text" class="form-control" id="idtiendaV" name="idtiendaV" value=""
                            hidden>
                        <div class="mb-3">
                            <label for="reservas" class="form-label">Reservas</label>
                            <select type="text" class="form-control" id="reservas" name="reservas">

                            </select>
                        </div>
                        <div class="nuevaReserva" style="display: none;">
                            <input type="text" class="form-control" id="idn" name="idn"
                                value="{{ Session::get('usuario_id') }}" hidden>
                            <div class="mb-3">
                                <label for="asesor" class="form-label">Asesor</label>
                                <input type="text" class="form-control" id="asesor"
                                    value="{{ Session::get('usuario') }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="cargo" class="form-label" id="cargoTn">Empresa o Socio</label>
                                <input type="text" class="form-control" id="cargon" value="" readonly>
                            </div>
                            <hr>
                            <p>Datos Cliente:</p>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombres y Apellidos</label>
                                <input type="text" class="form-control" id="namen" name="namen">
                            </div>
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI – RUC </label>
                                <input type="text" class="form-control" id="dnin" name="dnin">
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Direcci&oacute;n</label>
                                <input type="text" class="form-control" id="direccionn" name="direccionn">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Celular</label>
                                <input type="phone" class="form-control" id="telefonon" name="telefonon">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correon" name="correon">
                            </div>
                            <div class="mb-3">
                                <label for="ocupacion" class="form-label">Ocupaci&oacute;n</label>
                                <input type="text" class="form-control" id="ocupacionn" name="ocupacionn">
                            </div>
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto</label>
                                <input type="bumber" class="form-control" id="monton" name="monton">
                            </div>
                            <div class="mb-3">
                                <label for="comentario" class="form-label">Descripcion</label>
                                <textarea class="form-control" id="comentarion" name="comentarion"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="cuenta" class="form-label">N&deg; Cuenta</label>
                            <select type="text" class="form-control" id="cuenta" name="cuenta">

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="voucher" class="form-label">Adjuntar Voucher</label>
                            <input class="form-control" type="file" id="voucher" accept=".png, .jpg, .jpeg">
                            <div id="file-error" style="color: red; display: none;">Solo se permiten archivos PNG y JPG.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="contratos" class="form-label">Adjuntar Contratos</label>
                            <input class="form-control" type="file" id="contratos" accept=".pdf" multiple>
                            <div id="file-error" style="color: red; display: none;">Solo se permiten archivos PDF.</div>
                        </div>
                        <div class="mb-3">
                            <label for="tipoPago" class="form-label">Tipo de Pago</label>
                            <select type="text" class="form-control" id="tipoPago" name="tipoPago">
                                <option value="Transferencia">Transferencia</option>
                                <option value="Pago efectivo">Pago efectivo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="convenio" class="form-label">Convenio Separaci&oacute;n</label>
                            <input class="form-control" type="text" id="convenio" name="convenio">
                        </div>
                        <div class="mb-3">
                            <label for="convenio" class="form-label">Credito</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="unicachi"
                                    value="unicachi">
                                <label class="form-check-label" for="unicachi">Unicachi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="otros"
                                    value="otros">
                                <label class="form-check-label" for="otros">Otros</label>
                            </div>
                            <div class="mb-3" id="otrosInputContainer" style="display: none;">
                                <label for="otrosInput" class="form-label">Especificar</label>
                                <input type="text" class="form-control" id="otrosInput" name="otrosInput">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="contado" class="form-label">Contado</label>
                            <select type="text" class="form-control" id="contado" name="contado">
                                <option value="si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="saveVenta">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewVentaModal" tabindex="-1" aria-labelledby="viewVentaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewVentaModalLabel">Detalle de Venta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="viewVentaForm">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Asesor</th>
                                        <th scope="col" id="cargoT">Empresa</th>
                                        <th scope="col">Nombres y Apellidos</th>
                                        <th scope="col">DNI - RUC</th>
                                        <th scope="col">Direcci&oacute;n</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Ocupaci&oacute;n</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyV">

                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="viewCuenta" class="form-label">N&deg; Cuenta</label>
                            <input type="text" class="form-control readonly" id="viewCuenta" readonly>
                        </div>
                        <div class="mb-3" style="display: flex; flex-direction: column;">
                            <label for="viewVoucher" class="form-label">Voucher</label>
                            <div>
                                <button type="button" class="btn btn-primary" id="viewVoucherBtn"><i
                                        class="bi bi-eye-fill"></i> Ver Voucher</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="viewContratos" class="form-label">Contratos</label>
                            <div id="viewContratosList"
                                style="display: flex; flex-direction: column; width: fit-content;">

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="viewTipoPago" class="form-label">Tipo de Pago</label>
                            <input type="text" class="form-control readonly" id="viewTipoPago" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="viewConvenio" class="form-label">Convenio</label>
                            <input type="text" class="form-control readonly" id="viewConvenio" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="viewCredito" class="form-label">Credito</label>
                            <input type="text" class="form-control readonly" id="viewCredito" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="viewContado" class="form-label">Contado</label>
                            <input type="text" class="form-control readonly" id="viewContado" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="vendedorDetalle" tabindex="-1" aria-labelledby="vendedorDetalleLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="vendedorDetalleLabel">Detalle Reserva</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-striped-columns">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Asesor</th>
                                <th scope="col" id="cargoT">Empresa</th>
                                <th scope="col">Nombres y Apellidos</th>
                                <th scope="col">DNI - RUC</th>
                                <th scope="col">Direcci&oacute;n</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Ocupaci&oacute;n</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let token = "{{ csrf_token() }}";

        $('#switch').change(function() {
            if ($(this).is(':checked')) {
                $('#zona').html('Ir al piso 1');
                $('.piso').hide();
                $('.sotano').show();
            } else {
                $('#zona').html('Ir al sotano');
                $('.piso').show();
                $('.sotano').hide();
            }
        });

        $('.addComprador').click(function() {
            $('#regresar').hide();
            let id = $(this).attr("data-id");
            let estado = $(this).attr("data-estado");
            let cargo = $(this).attr('data-cargo');
            let rol = "{{ Session::get('rol') }}";
            let nombreTienda = $(this).data('tienda');
            let numero = $(this).data('numero');
            if (rol !== "3") {
                let flag = estado == "3";
                let texto = flag ? 'Ver detalle' : 'Asignar reserva';
                let detalle = estado !== "4" ?
                    `<div><button type="button" class="btn btn-success" id="detalle">${texto}</button></div>` : '';
                let showVenta = estado == "4" ?
                    `<button type="button" class="btn btn-danger" onclick="viewVentaBtn(${id})">Ver detalle venta</button>` :
                    '';
                Swal.fire({
                    title: `<strong>Detalle: ${nombreTienda}:${numero}</strong>`,
                    icon: "info",
                    html: `<div style="display: flex; justify-content: space-evenly;">
                                <div>
                                    <button type="button" class="btn btn-primary" onclick="updateColor(${id}, ${estado}, '${cargo}')">Cambiar Estado</button>
                                </div>
                                ${detalle}
                                
                                ${showVenta}
                            </div>`,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    cancelButtonText: `Cancelar`,
                    confirmButtonText: 'Cerrar'
                });
                $("#detalle").click(function() {
                    if (flag) {
                        showDetalle(id, cargo);
                    } else {
                        showCrear(id, cargo);
                    }
                });
            } else {
                if (estado == "5") {
                    Swal.fire({
                        title: "Info",
                        text: "El puesto se encuentra bloqueado por el Administrador.",
                        icon: "info"
                    });
                    return;
                }
                if (estado == "3") {
                    showDetalle(id, cargo);
                    return;
                }
                if (estado == "4") {
                    viewVentaBtn(id);
                    return;
                }
                showCrear(id, cargo);
            }
        });

        function showDetalle(id, cargo) {
            $.post("{{ route('getComprador') }}", {
                    _token: token,
                    id: id
                },
                function(data, textStatus, jqXHR) {
                    let reserva = JSON.parse(data);
                    let tbody = ``;
                    $.each(reserva, function(i, v) {
                        tbody += '<tr>';
                        tbody += `<td>${i + 1}</td>`;
                        tbody += `<td>${v.asesor}</td>`;
                        if (v.nombre_cargo) {
                            let partes = (v.nombre_cargo).split('/');
                            $('#cargoT').html(partes[0]);
                            tbody += `<td>${partes[1]}</td>`;
                        } else {
                            tbody += `<td>${v.nombre_cargo}</td>`;
                        }
                        tbody += `<td>${v.nombre}</td>`;
                        tbody += `<td>${v.documento}</td>`;
                        tbody += `<td>${v.direccion}</td>`;
                        tbody += `<td>${v.celular}</td>`;
                        tbody += `<td>${v.correo}</td>`;
                        tbody += `<td>${v.ocupacion}</td>`;
                        tbody += `<td>${v.monto}</td>`;
                        tbody += `<td>${v.direccion}</td>`;
                        tbody += `<td>${v.venta ? 'vendido' : 'reserva'}</td>`;
                        tbody += `<td>${v.fecha}</td>`;
                        tbody += '</tr>';
                    });
                    $('#tbody').html(tbody);
                    Swal.close();
                    $('#vendedorDetalle').modal('show');
                },
            );
        }

        function showCrear(id, cargo) {
            $('#formComprador')[0].reset();
            $('#idtienda').val(id);
            if (cargo) {
                let partes = cargo.split('/');
                $('#tipoCargo').html(partes[0]);
                $('#cargo').val(partes[1]);
            }
            $('#saveComprador').show();
            $('#vendedorAdd').modal('show');
            Swal.close();
        }

        $('#saveComprador').click(function() {
            let data = {
                id: $('#id').val(),
                idTienda: $('#idtienda').val(),
                nombre: $('#name').val(),
                documento: $('#dni').val(),
                direccion: $('#direccion').val(),
                celular: $('#telefono').val(),
                correo: $('#correo').val(),
                ocupacion: $('#ocupacion').val(),
                monto: $('#monto').val(),
                comentario: $('#comentario').val()
            };

            if (validateForm(data)) {
                $.post("{{ route('saveComprador') }}", {
                        _token: token,
                        data: data
                    })
                    .done(function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Info",
                            text: "Se registro correctamente",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                getCuentasBancos($('#telefono').val());
                                location.reload();
                            } else if (result.isDenied) {
                                getCuentasBancos($('#telefono').val());
                                location.reload();
                            }
                        });;
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        // Manejar errores
                        console.error('Error al guardar los datos:', textStatus, errorThrown);
                    });
            } else {
                Swal.fire({
                    icon: "info",
                    title: "Info",
                    text: "Todos los campos son requeridos",
                });
            }
        });

        function updateColor(id, estado, cargo) {
            $.get("{{ route('getEstados') }}",
                function(data, textStatus, jqXHR) {
                    let estados = JSON.parse(data);
                    let flag = cargo == '';
                    if (!flag) {
                        $.post("{{ route('getStatusTienda') }}", {
                                _token: token,
                                idTienda: id,
                            },
                            function(data, textStatus, jqXHR) {
                                let tieneReserva = data;
                                cargarEstados(estados, flag, estado, tieneReserva);
                            },
                        );
                    } else {
                        cargarEstados(estados, flag, estado);
                    }
                    $('#idtiendaU').val(id);
                    $('#cargoC').val(cargo);
                },
            );
            $('#updateColor').modal('show');
            $('#saveColor').attr("data-id", id)
            Swal.close();
        }

        function cargarEstados(estados, flag, estado, reserva = false) {
            let option = '<option value="">--Elegir--</option>';
            if (estado == 5) {
                option += `<option value="0">${'Desbloquear'}</option>`;
            } else {
                $.each(estados, function(i, v) {
                    if (!flag) {
                        if (v.id !== 1 && v.id !== 2) {
                            if (reserva == '1' && v.id !== 3 && estado !== 4) {
                                option +=
                                    `<option value="${v.id}">${capitalizeFirstLetter(v.descripcion)}</option>`;
                            }

                            if (reserva == '1' && v.id !== 3 && estado == 4 && v.id !== 4) {
                                option +=
                                    `<option value="${v.id}">${capitalizeFirstLetter(v.descripcion)}</option>`;
                            }

                            if (reserva !== '1') {
                                option +=
                                    `<option value="${v.id}">${capitalizeFirstLetter(v.descripcion)}</option>`;
                            }

                        }
                    } else {
                        if (v.id == 1 || v.id == 2 || v.id == 5) {
                            option +=
                                `<option value="${v.id}">${capitalizeFirstLetter(v.descripcion)}</option>`;
                        }
                    }
                });
            }
            $('#estado').html(option);
        }

        $('#saveColor').click(function() {
            let estado = $('#estado').val();
            let nombreCargo = $('#nombreCargo').val();
            $.post("{{ route('saveColor') }}", {
                    _token: token,
                    id: $("#saveColor").data("id"),
                    estado: estado,
                    nombreCargo: nombreCargo
                },
                function(data, textStatus, jqXHR) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Se guardo correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1500);

                },
            );
        });

        function validateForm(data) {
            for (const key in data) {
                if (data[key] === '' || data[key] === null || data[key] === undefined) {
                    return false;
                }
            }
            return true;
        }

        function enviarMensajeWhatsApp(telefono, cuentas) {
            var mensaje = encodeURIComponent(
                `Hola, le enviamos los números de cuenta:\n${cuentas}`);
            window.open('https://wa.me/' + telefono + '?text=' + mensaje, '_blank');
        }

        $('#estado').change(function() {
            let value = $(this).val();
            $('.nombre_cargo').hide();
            if (value == 1 || value == 2) {
                $('.nombre_cargo').show();
            }
            if (value == 3) {
                $('#updateColor').modal('hide');
                $('#vendedorAdd').modal('show');
                let cargo = $('#cargoC').val();
                if (cargo) {
                    $('#cargo').val(cargo);
                }
                $('#regresar').show();
            }
            if (value == 4) {
                $('#updateColor').modal('hide');
                getCuentasBancos();
                let idtienda = $('#idtiendaU').val();
                $.post("{{ route('getComprador') }}", {
                        _token: token,
                        id: idtienda
                    },
                    function(data, textStatus, jqXHR) {
                        let reserva = JSON.parse(data);
                        let option = `<option value="">--Elegir--</option>`;
                        option += `<option value="nuevo">Nuevo reserva</option>`;
                        $.each(reserva, function(i, v) {
                            option += `<option value="${v.id_reserva}">${v.nombre}</option>`;
                        });
                        $('#reservas').html(option);
                    },
                );
                $('#addCompraTiendaModal').modal('show');
            }
        });

        $('#reservas').change(function() {
            let value = $(this).val();
            if (value == 'nuevo') {
                let cargo = $('#cargoC').val();
                if (cargo) {
                    let partes = (cargo).split('/');
                    $('#cargoTn').html(partes[0]);
                    $('#cargon').val(partes[1]);
                }
                $('.nuevaReserva').show();
            } else {
                $('.nuevaReserva').hide();
            }
        });

        function getCuentasBancos(telefono = null) {
            $.get("{{ route('getCuentas') }}",
                function(data, textStatus, jqXHR) {
                    let cuentas = JSON.parse(data);
                    if (telefono == null) {
                        let option = '<option value="">--Elegir--</option>';
                        $.each(cuentas, function(i, v) {
                            option +=
                                `<option value="${v.tipo}-${v.cuenta}-${v.banco}">${v.tipo}-${v.cuenta}-${v.banco}</option>`;
                        });
                        let idTienda = $('#idtiendaU').val();
                        $('#idtiendaV').val(idTienda);
                        $('#cuenta').html(option);
                    } else {
                        let cuentasText = "";
                        $.each(cuentas, function(i, v) {
                            cuentasText += `${v.tipo}: ${v.cuenta} - ${v.banco}\n`;
                        });
                        enviarMensajeWhatsApp(telefono, cuentasText);
                    }
                },
            );
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        $('#regresar').click(function() {
            $('#updateColor').modal('show');
            $('#vendedorAdd').modal('hide');
        });

        document.getElementById('voucher').addEventListener('change', function() {
            var fileInput = this;
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

            if (!allowedExtensions.exec(filePath)) {
                document.getElementById('file-error').style.display = 'block';
                fileInput.value = ''; // Limpiar el valor del input
                return false;
            } else {
                document.getElementById('file-error').style.display = 'none';
            }
        });

        document.getElementById('contratos').addEventListener('change', function() {
            var fileInput = this;
            var files = fileInput.files;
            var allowedExtensions = /(\.pdf)$/i;
            var allValid = true;

            for (var i = 0; i < files.length; i++) {
                if (!allowedExtensions.exec(files[i].name)) {
                    allValid = false;
                    break;
                }
            }

            if (!allValid) {
                document.getElementById('file-error').style.display = 'block';
                fileInput.value = ''; // Limpiar el valor del input
            } else {
                document.getElementById('file-error').style.display = 'none';
            }
        });

        $('input[name="flexRadioDefault"]').change(function() {
            var otrosInputContainer = $('#otrosInputContainer');
            var otrosInput = $('#otrosInput');

            if ($(this).val() === 'otros') {
                otrosInputContainer.show();
            } else {
                otrosInputContainer.hide();
                otrosInput.val(''); // Limpiar el campo de texto
            }
        });

        $('#saveVenta').click(function() {
            // Validate required fields
            var isValid = true;
            $('#formVenta input, #formVenta select').each(function() {
                if ($(this).prop('required') && $(this).val() === '') {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Handle file validation
            var voucherFile = $('#voucher')[0].files[0];
            var contratoFiles = $('#contratos')[0].files;
            if (voucherFile && !['image/png', 'image/jpg', 'image/jpeg'].includes(voucherFile.type)) {
                isValid = false;
                $('#voucher').addClass('is-invalid');
                $('#file-error').show();
            } else {
                $('#voucher').removeClass('is-invalid');
                $('#file-error').hide();
            }
            if (contratoFiles.length > 0) {
                for (var i = 0; i < contratoFiles.length; i++) {
                    if (contratoFiles[i].type !== 'application/pdf') {
                        isValid = false;
                        $('#contratos').addClass('is-invalid');
                        $('#file-error').show();
                        break;
                    } else {
                        $('#contratos').removeClass('is-invalid');
                        $('#file-error').hide();
                    }
                }
            }

            if (!isValid) {
                return;
            }

            // Create FormData object
            var formData = new FormData($('#formVenta')[0]);
            formData.append('voucher', voucherFile);
            formData.append('_token', token);
            for (var i = 0; i < contratoFiles.length; i++) {
                formData.append('contratos[]', contratoFiles[i]);
            }

            // Send data via AJAX
            $.ajax({
                url: '{{ route('saveVenta') }}', // Cambiar por la ruta de tu controlador
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle successful response
                    Swal.fire({
                        icon: "success",
                        title: "Info",
                        text: "Se registro correctamente",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#addCompraTiendaModal').modal('hide');
                            $('#formVenta')[0].reset();
                            $('#otrosInputContainer').hide();
                            location.reload();
                        } else if (result.isDenied) {
                            $('#addCompraTiendaModal').modal('hide');
                            $('#formVenta')[0].reset();
                            $('#otrosInputContainer').hide();
                            location.reload();
                        }
                    });;

                },
                error: function(response) {
                    // Handle error response
                    alert('Hubo un error al guardar los datos');
                }
            });
        });

        function viewVentaBtn(ventaId) {
            $.ajax({
                url: '{{ route('getVenta') }}',
                type: 'GET',
                data: {
                    id: ventaId
                },
                success: function(venta) {
                    $.post("{{ route('getComprador') }}", {
                            _token: token,
                            id: ventaId
                        },
                        function(data, textStatus, jqXHR) {
                            let reserva = JSON.parse(data);
                            let tbody = ``;
                            $.each(reserva, function(i, v) {
                                tbody += '<tr>';
                                tbody += `<td>${i + 1}</td>`;
                                tbody += `<td>${v.asesor}</td>`;
                                if (v.nombre_cargo) {
                                    let partes = (v.nombre_cargo).split('/');
                                    $('#cargoT').html(partes[0]);
                                    tbody += `<td>${partes[1]}</td>`;
                                } else {
                                    tbody += `<td>${v.nombre_cargo}</td>`;
                                }
                                tbody += `<td>${v.nombre}</td>`;
                                tbody += `<td>${v.documento}</td>`;
                                tbody += `<td>${v.direccion}</td>`;
                                tbody += `<td>${v.celular}</td>`;
                                tbody += `<td>${v.correo}</td>`;
                                tbody += `<td>${v.ocupacion}</td>`;
                                tbody += `<td>${v.monto}</td>`;
                                tbody += `<td>${v.direccion}</td>`;
                                tbody += `<td>${v.venta ? 'vendido' : 'reserva'}</td>`;
                                tbody += `<td>${v.fecha}</td>`;
                                tbody += '</tr>';
                            });
                            $('#tbodyV').html(tbody);
                        },
                    );

                    // Cargar datos en el modal
                    $('#viewCuenta').val(venta.cuenta);
                    $('#viewTipoPago').val(venta.tipoPago);
                    $('#viewConvenio').val(venta.convenio);
                    $('#viewCredito').val(venta.credito);
                    $('#viewContado').val(venta.contado);

                    // Configurar el bot&oacute;n para ver el voucher
                    $('#viewVoucherBtn').off('click').on('click', function() {
                        window.open('/storage/' + venta.voucher, '_blank');
                    });

                    // Configurar la lista de contratos
                    var contratosList = $('#viewContratosList');
                    contratosList.empty();
                    JSON.parse(venta.contratos).forEach(function(contrato, index) {
                        var contratoBtn = $(
                            '<button type="button" class="btn btn-primary mb-2" id="viewVoucherBtn"><i class="bi bi-eye-fill"></i>Ver Contrato ' +
                            (
                                index + 1) + '</button>');
                        contratoBtn.click(function() {
                            window.open('/storage/' + contrato, '_blank');
                        });
                        contratosList.append(contratoBtn);
                    });
                    Swal.close();
                    // Mostrar el modal
                    $('#viewVentaModal').modal('show');
                },
                error: function() {
                    alert('Error al obtener los datos de la venta.');
                }
            });
        }
    </script>
@endsection
