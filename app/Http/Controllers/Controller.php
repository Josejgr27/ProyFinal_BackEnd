<?php

namespace App\Http\Controllers;

use App\Http\Filters\FilterProy;
use App\Models\Beca;
use App\Models\BecasReq;
use App\Models\EstudBecas;
use App\Models\Estudiante;
use App\Models\EstudMaterias;
use App\Models\Materia;
use App\Models\Requisitos;
use Error;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ShowBecas(Request $r)
    {
        try {
            $b = (new FilterProy)->filterBecas($r);
            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Error $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function ShowAlumnos(Request $r)
    {
        try {
            $a = (new FilterProy)->filterEstudiantes($r);
            return response()->json(['status' => 200, 'response' => $a]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function ShowMaterias(Request $r)
    {
        try {
            $m = (new FilterProy)->filterMaterias($r);
            return response()->json(['status' => 200, 'response' => $m]);
        } catch (Error $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }


    public function ShowRequisitos(Request $r)
    {
        try {
            $m = (new FilterProy)->filterRequisitos($r);
            $m->map(function ($s) {
                $s->req = $s->requisito->requ;
            })->values()->all();
            return response()->json(['status' => 200, 'response' => $m]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function ShowRequisitosP(Request $r)
    {
        try {
            $m = (new FilterProy)->filterRequisitosP($r);
            
            return response()->json(['status' => 200, 'response' => $m]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function ShowCalificaciones(Request $r)
    {
        try {
            $m = (new FilterProy)->filterCalificaciones($r);

            return response()->json(['status' => 200, 'response' => $m]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function ShowBecasAlumnos(Request $r)
    {
        try {
            $m = (new FilterProy)->filterBecasAlumnos($r);
            $m->map(function ($s) {
            })->values()->all();
            return response()->json(['status' => 200, 'response' => $m]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function CreateBeca(Request $r)
    {
        try {
            $b = $r->id ? Beca::find($r->id) : new Beca();
            $b->tipo = $r->tipo;
            $b->monto = $r->monto;
            $b->duracion = $r->duracion;
            $b->save();
            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function CreateAlumno(Request $r)
    {
        try {
            $b = $r->id ? Estudiante::find($r->id) : new Estudiante();
            $b->nombre = $r->nombre;
            $b->apellidos = $r->apellidos;
            $b->noControl = $r->noControl;
            $b->fech_nac = $r->fech_nac;
            $b->semestre = $r->semestre;
            $b->modalidad = $r->modalidad;
            $b->save();

            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function CreateMateria(Request $r)
    {
        try {
            $b = $r->id ? Materia::find($r->id) : new Materia();
            $b->nombre = $r->nombre;
            $b->responsable = $r->responsable;
            $b->horario = $r->horario;
            $b->semestre = $r->semestre;
            $b->save();

            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function CreateRequisito(Request $r)
    {
        try {
            $b = $r->id ? Requisitos::find($r->id) : new Requisitos();
            $b->requisito = $r->requisito;
            $b->descripcion = $r->descripcion;
            $b->fecha_revision = $r->fecha_revision;
            $b->nivel = 1;
            $b->save();

            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function DeleteMateria(Request $r)
    {
        try {
            $b =  Materia::find($r->id);
            $b->delete();

            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function DeleteBeca(Request $r)
    {
        try {
            $b =  Beca::find($r->id);
            $b->delete();

            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function DeleteAlumno(Request $r)
    {
        try {
            $b =  Estudiante::find($r->id);
            $b->delete();

            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function DeleteReq(Request $r)
    {
        try {
            $b =  Requisitos::find($r->id);
            $b->delete();

            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    /* RELACIONES */

    public function CreateReqBecas(Request $r)
    {
        try {
            $b = $r->id ? BecasReq::find($r->id) : new BecasReq();
            $b->id_beca = $r->id_beca;
            $b->id_requisito = $r->id_requisito;
            $b->puntaje = $r->puntaje;
            $b->save();
            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function CreateMatEst(Request $r)
    {
        try {
            $b = $r->id ? EstudMaterias::find($r->id) : new EstudMaterias();
            $b->id_estudiante = $r->id_estudiante;
            $b->id_materia = $r->id_materia;
            $b->calificacion = $r->calificacion;
            $b->save();
            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }

    public function CreateBecEst(Request $r)
    {
        try {
            $b = $r->id ? EstudBecas::find($r->id) : new EstudBecas();
            $b->id_beca = $r->id_beca;
            $b->id_estudiante = $r->id_estudiante;
            $b->fecha_inicio = $r->fecha_inicio;
            $b->status = 1;
            $b->save();
            return response()->json(['status' => 200, 'response' => $b]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'response' => $e]);
        }
    }
}
