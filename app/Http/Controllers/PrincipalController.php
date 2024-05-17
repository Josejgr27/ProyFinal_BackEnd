<?php

namespace App\Http\Controllers;

use App\Http\Filters\FilterProy;
use Error;
use Exception;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
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

}
