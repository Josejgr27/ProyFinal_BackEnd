<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Requisitos;

class BecasReq extends Model
{
    use HasFactory;

    protected $table = 'becas_requisitos';

    protected $fillable = [
        'id',
        'id_beca',
        'id_requisito',
        'puntaje',
    ];

    public function requisito()
    {
        return $this->hasOne(Requisitos::class, 'id', 'id_requisito');
    }
}
