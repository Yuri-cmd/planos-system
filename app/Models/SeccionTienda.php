<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionTienda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'secciones_tienda';
    protected $primaryKey = 'id_tienda';
    protected $fillable = [
        'id_seccion',
        'numeracion',
        'estado',
        'nombre_cargo'
    ];
}
