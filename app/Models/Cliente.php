<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'cliente';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombreUser',
        'nombre',
        'dni',
        'telefono',
        'visita',
        'rubro',
        'tipoVenta',
        'vendedor',
    ];
}
