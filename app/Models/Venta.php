<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'idtienda',
        'cuenta',
        'voucher',
        'contratos',
        'tipoPago',
        'convenio',
        'credito',
        'otrosInput',
        'contado'
    ];

    protected $casts = [
        'contratos' => 'array'
    ];

     // Definir la relación con la tabla reservas
     public function reserva()
     {
         return $this->belongsTo(Reserva::class, 'id_reserva');
     }
 
     // Definir la relación con la tabla usuarios a través de reservas
     public function usuario()
     {
         return $this->hasOneThrough(Usuario::class, Reserva::class, 'id_reserva', 'id', 'id_reserva', 'id_asesor');
     }
 
     // Definir la relación con la tabla secciones_tienda a través de reservas
     public function seccionTienda()
     {
         return $this->hasOneThrough(SeccionTienda::class, Reserva::class, 'id_reserva', 'id_tienda', 'id_reserva', 'id_tienda');
     }
}
