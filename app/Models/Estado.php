<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    // Nombre de la tabla de estados
    protected $table = 'estados';

    // Relación o método para obtener el color por id
    public static function getColorById($id)
    {
        $estado = self::find($id);

        if ($estado) {
            return $estado->color;
        }

        return '#d0d0d0'; // Color por defecto si no se encuentra el estado
    }
}
