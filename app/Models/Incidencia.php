<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    // Especifica la tabla si el nombre no sigue el plural estándar de Laravel
    protected $table = 'incidencias';

    // Campos asignables para protección contra asignación masiva
    protected $fillable = [
        'dni',
        'titulo',
        'descripcion',
        'archivo',  // Esto puede almacenar la ruta del archivo JPG
        'laboratorio'
    ];

    // Si necesitas usar marcas de tiempo de creación y actualización, asegúrate de que estén habilitadas.
    public $timestamps = true;

    // Relación si necesitas asociar las incidencias a otros modelos (opcional)
    // public function usuario()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
