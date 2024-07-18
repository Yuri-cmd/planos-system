<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\CuentaBancaria;
use App\Models\Reserva;
use App\Models\Rol;
use App\Models\SeccionTienda;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $seccion1 = $this->get_tiendas(1);
        $seccion2 = $this->get_tiendas(2);
        $seccion3 = $this->get_tiendas(3);
        $seccion4 = $this->get_tiendas(4);
        $seccion5 = $this->get_tiendas(5);
        return view('dashboard', compact("seccion1", "seccion2", "seccion3", "seccion4", "seccion5"));
    }

    public function getEstados()
    {
        $estados = DB::table('estados')->get();
        return json_encode($estados);
    }

    public function get_tiendas($sec)
    {
        // Realizar la consulta
        $secciones = DB::table('secciones as s')
            ->join('secciones_tienda as st', 'st.id_seccion', '=', 's.id')
            ->where('s.seccion', $sec)
            ->select('s.*', 'st.*')
            ->get();
        // dd($secciones);
        // Inicializar el array para almacenar los datos agrupados
        $data = [];

        // Iterar sobre los resultados para agrupar las tiendas por sección
        foreach ($secciones as $seccion) {
            // Verificar si la sección ya está en el array $data
            if (!isset($data[$seccion->id])) {
                // Si no existe, inicializar la sección
                $data[$seccion->id] = [
                    'seccion_id' => $seccion->id,
                    'seccion' => $seccion->seccion,
                    'nombre' => $seccion->nombre,
                    'tiendas' => [],
                ];
            }

            // Agregar la tienda a la sección correspondiente
            $data[$seccion->id]['tiendas'][] = [
                'id' => $seccion->id_tienda,
                'estado' => $seccion->estado,
                'nombreCargo' => $seccion->nombre_cargo,
                'numeracion' => $seccion->numeracion,
            ];
        }

        // Contar la cantidad de tiendas por sección
        foreach ($data as &$seccion) {
            $seccion['cantidad_tiendas'] = count($seccion['tiendas']);
        }
        return $data;
    }

    public function saveComprador(Request $request)
    {
        DB::insert(
            'insert into reserva (id_tienda,id_asesor,nombre,documento,direccion,celular,correo,ocupacion,monto,comentario) values (?,?,?,?,?,?,?,?,?,?)',
            [
                $request->data["idTienda"], $request->data["id"], "{$request->data["nombre"]}", "{$request->data["documento"]}", "{$request->data["direccion"]}", "{$request->data["celular"]}", "{$request->data["correo"]}", "{$request->data["ocupacion"]}", "{$request->data["monto"]}", "{$request->data["comentario"]}"
            ]
        );
        DB::table('secciones_tienda')
            ->where('id_tienda', $request->data["idTienda"])
            ->update([
                'estado' => 3,
            ]);
    }

    public function usuarios()
    {
        $roles = Rol::all();
        return view('usuarios', compact('roles'));
    }

    public function getUsuarios()
    {
        $usuarios = Usuario::with('rol')->get();
        return json_encode($usuarios);
    }

    public function saveUsuario(Request $request)
    {
        $usuario = new Usuario();
        $usuario->usuario = $request->usuario;
        $usuario->clave = $request->clave;
        $usuario->nombre = $request->nombre;
        $usuario->rol = $request->rol;
        $usuario->correo = $request->correo;
        $usuario->celular = $request->celular;
        $usuario->save();

        return response()->json(['mensaje' => 'Cliente guardado correctamente'], 200);
    }

    public function deleteUsuario(Request $request)
    {
        $ids = $request->input('ids');
        Usuario::whereIn('id', $ids)->delete();
        return response()->json(['mensaje' => 'Registros eliminados correctamente'], 200);
    }

    public function actualizarUsuario(Request $request)
    {
        $usuario = Usuario::findOrFail($request->id);
        $usuario->usuario = $request->usuario;
        $usuario->clave = $request->clave;
        $usuario->nombre = $request->nombre;
        $usuario->rol = $request->rol;
        $usuario->estado = $request->estado;
        $usuario->correo = $request->correo;
        $usuario->celular = $request->celular;
        $usuario->save();
        return response()->json(['mensaje' => 'Cliente actualizado correctamente'], 200);
    }

    public function getComprador(Request $request)
    {
        $reserva = DB::select("SELECT
                            r.id_reserva,
                            u.nombre as asesor,
                            s.nombre_cargo,
                            r.nombre,
                            r.documento,
                            r.direccion,
                            r.celular,
                            r.correo,
                            r.ocupacion,
                            r.monto,
                            r.comentario,
                            v.id_reserva as venta,
                            date(r.fecha) as fecha
                        FROM
                            reserva r
                            INNER JOIN usuario u on u.id = r.id_asesor
                            INNER JOIN secciones_tienda s on s.id_tienda = r.id_tienda
                            LEFT JOIN ventas v on v.id_reserva = r.id_reserva
                        WHERE
                            r.id_tienda = {$request->id}
                        ORDER BY
	                        r.id_reserva");
        return json_encode($reserva);
    }

    public function saveColor(Request $request)
    {
        if ($request->estado == 6) {
            $tienda = SeccionTienda::findOrFail($request->id);
            $nombre = $tienda->nombre_cargo ?: null;
            $estado = $this->determinarEstado($nombre);
            $this->actualizarTienda($tienda, $nombre, $estado);
            return response()->json(true);
        } elseif (trim($request->estado) !== '' && $request->estado !== 0) {
            $tienda = SeccionTienda::findOrFail($request->id);
            $nombre = $this->getNombreCargo($tienda, $request->estado, $request->nombreCargo);
            $this->actualizarTienda($tienda, $nombre, $request->estado);
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    function getNombreCargo($tienda, $estado, $nombreCargo)
    {
        if ($estado == 1) {
            return 'Empresa/' . $nombreCargo;
        } elseif ($estado == 2) {
            return 'Socio/' . $nombreCargo;
        } elseif ($estado == 5 && $tienda->nombre_cargo) {
            return $tienda->nombre_cargo;
        } elseif ($estado == 0) {
            return null;
        } else {
            return $nombreCargo;
        }
    }

    function actualizarTienda($tienda, $nombre, $estado)
    {
        $tienda->nombre_cargo = $nombre;
        $tienda->estado = $estado;
        $tienda->save();
    }

    function determinarEstado($nombreCargo)
    {
        if (strpos($nombreCargo, 'Socio') !== false) {
            return 2;
        } elseif (strpos($nombreCargo, 'Empresa') !== false) {
            return 1;
        }
        return 6; // Estado por defecto si no coincide con 'Socio' o 'Empresa'
    }

    public function clientes()
    {
        return view('clientes');
    }

    public function getClientes()
    {
        $clientes = Cliente::all();
        return json_encode($clientes);
    }

    public function saveCliente(Request $request)
    {
        $existeDNI = Cliente::where('dni', $request->dni)->get();
        $existeTelefono = Cliente::where('telefono', $request->telefono)->get();
        if (!$existeDNI->isEmpty()) {
            return response()->json(['mensaje' => 'Ya existe el DNI registrado', 'status' => false], 200);
        }

        if (!$existeTelefono->isEmpty()) {
            return response()->json(['mensaje' => 'Ya existe el telefono registrado', 'status' => false], 200);
        }
        $cliente = new Cliente();
        $cliente->nombreUser = Session::get('nombre');
        $cliente->nombre = $request->nombre;
        $cliente->dni = $request->dni;
        $cliente->telefono = $request->telefono;
        $cliente->visita = $request->visita;
        $cliente->rubro = $request->rubro;
        $cliente->tipoVenta = $request->tipoVenta;
        // Guardar el cliente en la base de datos
        $cliente->save();
        // Devolver una respuesta (opcional)
        return response()->json(['mensaje' => 'Cliente guardado correctamente', 'status' => true], 200);
    }

    public function deleteCliente(Request $request)
    {
        $ids = $request->input('ids');
        Cliente::whereIn('id', $ids)->delete();
        return response()->json(['mensaje' => 'Registros eliminados correctamente'], 200);
    }

    public function actualizarCliente(Request $request)
    {
        $cliente = Cliente::findOrFail($request->id);
        $cliente->nombre = $request->nombre;
        $cliente->dni = $request->dni;
        $cliente->telefono = $request->telefono;
        $cliente->visita = $request->visita;
        $cliente->rubro = $request->rubro;
        $cliente->tipoVenta = $request->tipoVenta;
        // Actualiza más campos según sea necesario
        $cliente->save();


        // Devolver una respuesta (opcional)
        return response()->json(['mensaje' => 'Cliente actualizado correctamente'], 200);
    }

    public function getCuentas()
    {
        $cuentas = CuentaBancaria::all();
        return json_encode($cuentas);
    }

    public function saveVenta(Request $request)
    {
        if ($request->reservas == 'nuevo') {
            $reserva = new Reserva();
            $reserva->id_tienda = $request->idtiendaV;
            $reserva->id_asesor = $request->idn;
            $reserva->nombre = $request->namen;
            $reserva->documento = $request->dnin;
            $reserva->direccion = $request->direccionn;
            $reserva->celular = $request->telefonon;
            $reserva->correo = $request->correon;
            $reserva->ocupacion = $request->ocupacionn;
            $reserva->monto = $request->monton;
            $reserva->comentario = $request->comentarion;
            $reserva->save();

            // Obtener el ID de inserción
            $idInsercion = $reserva->id_reserva;
        }
        $validatedData = $request->validate([
            'cuenta' => 'required|string',
            'voucher' => 'required|mimes:png,jpg,jpeg|max:2048',
            'contratos' => 'required',
            'contratos.*' => 'mimes:pdf|max:2048',
            'tipoPago' => 'required|string',
            'convenio' => 'required|string',
            'flexRadioDefault' => 'required|string',
            'contado' => 'required|string',
        ]);

        $voucherPath = $request->file('voucher')->store('vouchers', 'public');
        $contratosPaths = [];
        if ($request->hasfile('contratos')) {
            foreach ($request->file('contratos') as $file) {
                $path = $file->store('contratos', 'public');
                $contratosPaths[] = $path;
            }
        }
        $idInsercion = isset($idInsercion) ? $idInsercion : $request->reservas;

        $venta = new Venta();
        $venta->idtienda = $request->idtiendaV;
        $venta->id_reserva = $idInsercion;
        $venta->cuenta = $request->cuenta;
        $venta->voucher = $voucherPath;
        $venta->contratos = json_encode($contratosPaths);
        $venta->tipoPago = $request->tipoPago;
        $venta->convenio = $request->convenio;
        $venta->credito = $request->flexRadioDefault;
        $venta->contado = $request->contado;
        $venta->save();

        DB::table('secciones_tienda')
            ->where('id_tienda', $request->idtiendaV)
            ->update([
                'estado' => 4,
            ]);;
        return response()->json(['success' => 'Datos guardados exitosamente']);
    }

    public function getVenta(Request $request)
    {
        $venta = Venta::where('idtienda', $request->id)->first();
        if (!$venta) {
            return response()->json(['error' => 'Venta no encontrada'], 404);
        }

        return response()->json($venta);
    }

    public function getStatusTienda(Request $request)
    {
        //validar si la tienda tiene reserva
        $reserva = Reserva::where('id_tienda', $request->idTienda)->get();
        if ($reserva->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }
}
