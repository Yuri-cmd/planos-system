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
}
