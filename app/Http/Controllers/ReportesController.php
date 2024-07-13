<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Models\Venta;
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

    public function viewVentasR(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $tipo = $request->input('tipo');

        $query = DB::table('ventas');

        if ($fecha_inicio) {
            $query->whereDate('created_at', '>=', $fecha_inicio);
        }
        if ($fecha_fin) {
            $query->whereDate('created_at', '<=', $fecha_fin);
        }

        $labels = [];
        $total_tipoPago = [];
        $total_contado = [];
        $total_credito = [];

        if ($tipo == 'tipoPago') {
            $data = $query->select('tipoPago', DB::raw('COUNT(*) as total'))
                ->groupBy('tipoPago')
                ->get();
            $labels = $data->pluck('tipoPago')->toArray();
            $total_tipoPago = $data->pluck('total')->toArray();
        } elseif ($tipo == 'contado') {
            $data = $query->select('contado', DB::raw('COUNT(*) as total'))
                ->groupBy('contado')
                ->get();
            $labels = $data->pluck('contado')->toArray();
            $total_contado = $data->pluck('total')->toArray();
        } elseif ($tipo == 'credito') {
            $data = $query->select('credito', DB::raw('COUNT(*) as total'))
                ->groupBy('credito')
                ->get();
            $labels = $data->pluck('credito')->toArray();
            $total_credito = $data->pluck('total')->toArray();
        } else {
            $tipoPagoData = $query->select('tipoPago', DB::raw('COUNT(*) as total'))
                ->groupBy('tipoPago')
                ->get();
            $contadoData = $query->select('contado', DB::raw('COUNT(*) as total'))
                ->groupBy('contado')
                ->get();
            $creditoData = $query->select('credito', DB::raw('COUNT(*) as total'))
                ->groupBy('credito')
                ->get();

            $labels_tipoPago = $tipoPagoData->pluck('tipoPago')->toArray();
            $labels_contado = $contadoData->pluck('contado')->toArray();
            $labels_credito = $creditoData->pluck('credito')->toArray();

            $labels = array_unique(array_merge($labels_tipoPago, $labels_contado, $labels_credito));

            $total_tipoPago = array_fill(0, count($labels), 0);
            $total_contado = array_fill(0, count($labels), 0);
            $total_credito = array_fill(0, count($labels), 0);

            foreach ($labels_tipoPago as $index => $label) {
                $key = array_search($label, $labels);
                $total_tipoPago[$key] = $tipoPagoData[$index]->total;
            }

            foreach ($labels_contado as $index => $label) {
                $key = array_search($label, $labels);
                $total_contado[$key] = $contadoData[$index]->total;
            }

            foreach ($labels_credito as $index => $label) {
                $key = array_search($label, $labels);
                $total_credito[$key] = $creditoData[$index]->total;
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'labels' => $labels,
                'total_tipoPago' => $total_tipoPago,
                'total_contado' => $total_contado,
                'total_credito' => $total_credito,
                'tipo' => $tipo
            ]);
        }

        return view('dashboard.ventas', compact('fecha_inicio', 'fecha_fin', 'tipo', 'labels', 'total_tipoPago', 'total_contado', 'total_credito'));
    }

    public function viewVentaAll()
    {
        $ventas = Venta::select(
            'ventas.created_at',
            'usuario.nombre as asesor_nombre',
            'secciones_tienda.nombre_cargo',
            'reserva.nombre',
            'reserva.documento',
            'reserva.direccion',
            'reserva.celular',
            'reserva.correo',
            'reserva.ocupacion',
            'reserva.monto',
            'reserva.comentario',
            'ventas.cuenta',
            'ventas.tipoPago',
            'ventas.convenio',
            'ventas.credito',
            'ventas.contado'
        )
            ->join('reserva', 'reserva.id_reserva', '=', 'ventas.id_reserva')
            ->join('usuario', 'usuario.id', '=', 'reserva.id_asesor')
            ->join('secciones_tienda', 'secciones_tienda.id_tienda', '=', 'reserva.id_tienda')
            ->get();
        return view('dashboard.reporte-venta', compact("ventas"));
    }
}
