<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $timestamps = false;
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $fillable = [
        'usuario',
        'clave',
        'nombre',
        'estado',
        'rol',
        'correo',
        'celular'
    ];
    
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol', 'id');
    }
}
