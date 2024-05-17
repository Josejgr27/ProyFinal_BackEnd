<?php

namespace App\Http\Filters;

use App\Models\Beca;
use App\Models\BecasReq;
use App\Models\EstudBecas;
use App\Models\Estudiante;
use App\Models\EstudMaterias;
use App\Models\Materia;
use App\Models\Requisitos;
use Illuminate\Http\Request;

class FilterProy
{
    public function filterEstudiantes(Request $r)
    {
        $e = (new Estudiante())->newQuery();

        !$r->id ?: $e->where('id', $r->id);
        !$r->nombre ?: $e->where('nombre', $r->nombre);
        !$r->apellidos ?: $e->where('apellidos', $r->apellidos);
        !$r->noControl ?: $e->where('noControl', $r->noControl);
        !$r->fech_nac ?: $e->where('fech_nac', $r->fech_nac);
        !$r->semestre ?: $e->where('semestre', $r->semestre);
        !$r->modalidad ?: $e->where('modalidad', $r->modalidad);

        $e = $e->get();

        $e->map(function ($s) {
            $s->boolBeca = EstudBecas::where('id_estudiante', $s->id)->first() ? 'SI' : 'NO';
        })->values()->all();

        return $e;
    }

    public function filterMaterias(Request $r)
    {
        $m = (new Materia())->newQuery();
        !$r->id ?: $m->where('id', $r->id);
        !$r->nombre ?: $m->where('nombre', $r->nombre);
        !$r->responsable ?: $m->where('responsable', $r->responsable);
        !$r->horario ?: $m->where('horario', $r->horario);
        !$r->semestre ?: $m->where('semestre', $r->semestre);

        $e = $m->get();

        $e->map(function ($s) {
            $s->boolEst = EstudMaterias::where('id_materia', $s->id)->first() ? 'SI' : 'NO';
        })->values()->all();

        return $e;
    }

    public function filterBecas(Request $r)
    {
        $b = (new Beca())->newQuery();

        !$r->id ?: $b->where('id', $r->id);
        !$r->tipo ?: $b->where('tipo', $r->tipo);
        !$r->monto ?: $b->where('monto', $r->monto);
        !$r->duracion ?: $b->where('duracion', $r->duracion);

        $e = $b->get();

        $e->map(function ($s) {
            $s->boolEst = EstudBecas::where('id_beca', $s->id)->first() ? 'SI' : 'NO';
        })->values()->all();

        return $e;
    }

    public function filterRequisitos(Request $r)
    {
        $m = (new BecasReq())->newQuery();
        !$r->id ?: $m->where('id', $r->id);
        !$r->id_beca ?: $m->where('id_beca', $r->id_beca);

        return $m->get();
    }

    public function filterRequisitosP(Request $r)
    {
        $m = (new Requisitos())->newQuery();
        !$r->id ?: $m->where('id', $r->id);

        return $m->get();
    }

    public function filterCalificaciones(Request $r)
    {
        $m = (new EstudMaterias())->newQuery();
        !$r->id ?: $m->where('id', $r->id);
        !$r->id_estudiante ?: $m->where('id_estudiante', $r->id_estudiante);
        !$r->id_materia ?: $m->where('id_materia', $r->id_materia);


        return $m->with('estudiante')->with('materia')->get();
    }

    public function filterBecasAlumnos(Request $r)
    {
        $m = (new EstudBecas())->newQuery();
        !$r->id ?: $m->where('id', $r->id);
        !$r->id_beca ?: $m->where('id_beca', $r->id_beca);
        !$r->id_estudiante ?: $m->where('id_estudiante', $r->id_estudiante);


        return $m->with('beca')->with('estudiante')->get();
    }
}
