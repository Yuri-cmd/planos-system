<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function viewTienda()
    {
        $results = Seccion::join('secciones_tienda', 'secciones_tienda.id_seccion', '=', 'secciones.id')
            ->join('estados', 'estados.id', '=', 'secciones_tienda.estado')
            ->where('secciones.nombre', '!=', 'empty')
            ->selectRaw('secciones_tienda.id_tienda, CONCAT_WS(" - ", secciones.nombre, secciones_tienda.numeracion) as tienda, secciones_tienda.nombre_cargo, estados.descripcion')
            ->get();
        return view('dashboard.tienda', compact('results'));
    }

    public function viewVentas(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $tipo = $request->input('tipo');

        $query = DB::table('usuario')
            ->leftJoin('reserva', function ($join) use ($fecha_inicio, $fecha_fin) {
                $join->on('usuario.id', '=', 'reserva.id_asesor');
                if ($fecha_inicio) {
                    $join->whereDate('reserva.fecha', '>=', $fecha_inicio);
                }
                if ($fecha_fin) {
                    $join->whereDate('reserva.fecha', '<=', $fecha_fin);
                }
            })
            ->leftJoin('ventas', 'ventas.id_reserva', '=', 'reserva.id_reserva');

        $data = $query->select(
            'usuario.nombre as asesor',
            DB::raw('COUNT(DISTINCT reserva.id_reserva) as total_reservas'),
            DB::raw('COUNT(DISTINCT ventas.id_reserva) as total_ventas')
        )
            ->groupBy('usuario.nombre')
            ->get();

        $labels = $data->pluck('asesor');
        $total_reservas = $data->pluck('total_reservas');
        $total_ventas = $data->pluck('total_ventas');

        if ($request->ajax()) {
            return response()->json([
                'labels' => $labels,
                'total_reservas' => $total_reservas,
                'total_ventas' => $total_ventas,
                'tipo' => $tipo
            ]);
        }

        return view('dashboard.ventas-reservas', compact('fecha_inicio', 'fecha_fin', 'tipo', 'labels', 'total_reservas', 'total_ventas'));
    }
}
