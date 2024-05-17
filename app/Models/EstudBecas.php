<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudBecas extends Model
{
    use HasFactory;

    protected $table = 'estudiantes_becas';

    protected $fillable = [
        'id',
        'id_beca',
        'id_estudiante',
        'fecha_inicio',
        'status'
    ];

    public function beca()
    {
        return $this->hasOne(Beca::class, 'id', 'id_beca');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id', 'id_estudiante');
    }
}
