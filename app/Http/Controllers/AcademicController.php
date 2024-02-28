<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class AcademicController extends Controller
{

    /* Crear la migracion, modelo, rutas y funciones*/
    public function createTerm(Request $request)
    {
    }

    public function updateTerm(Request $request)
    {
    }

    public function destroyTerm($id)
    {
    }

    public function getTerm($id)
    {
    }

    public function getProgramID($id)
    {
        $programID = Program::find($id);
        return $programID;
    }
}
