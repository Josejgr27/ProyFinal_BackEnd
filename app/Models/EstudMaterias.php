<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudMaterias extends Model
{
    use HasFactory;

    protected $table = 'estudiantes_materias';

    protected $fillable = [
        'id',
        'id_estudiante',
        'id_materia',
        'calificacion'
    ];

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id', 'id_estudiante');
    }

    public function materia()
    {
        return $this->hasOne(Materia::class, 'id', 'id_materia');
    }
}
