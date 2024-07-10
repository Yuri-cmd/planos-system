<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'cuentas_banco';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cuenta',
        'tipo',
        'moneda',
        'banco'
    ];
}
