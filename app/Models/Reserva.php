<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'reserva';
    protected $primaryKey = 'id_reserva';
    protected $fillable = [
        'id_tienda',
        'id_asesor',
        'nombre',
        'documento',
        'direccion',
        'celular',
        'correo',
        'ocupacion',
        'monto',
        'comentario',
        'estado',
        'fecha',
    ];
}
