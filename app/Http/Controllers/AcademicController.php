<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use App\Models\Program;
use App\Models\Term;
use Illuminate\Http\Request;

class AcademicController extends Controller
{

    /* Crear la migracion, modelo, rutas y funciones*/
    public function createTerm(Request $request,$id)
    {
        $cicloEscolar = Term::find($id);

        if (!$cicloEscolar) {
            return response()->json(['mensaje' => 'Ciclo escolar no encontrado'], 404);
        }
        
        // Crea un nuevo ciclo escolar
        $cicloEscolar = Term::create([
            'Name' => $request->input('Name'),
            'StartDate' => $request->input('NameStart'),
            'EndDate' => $request->input('NameEnd'),
        ]);

        return response()->json(['mensaje' => 'Ciclo creado correctamente', 'ciclo_escolar' => $cicloEscolar], 201);
    }

    public function updateTerm(Request $request, $id)
    {
        $cicloEscolar = Term::find($id);

        if (!$cicloEscolar) {
            return response()->json(['mensaje' => 'Ciclo escolar no encontrado'], 404);
        }
        $cicloEscolar->update([
            'Name' => $request->input('Name'),
            'StartDate' => $request->input('NameStart'),
            'EndDate' => $request->input('EndDate'),
        ]);
        
    return response()->json(['mensaje'=>'El ciclo se actualizado correctamente','ciclo_escolar'=>$cicloEscolar],200);
    
    }

    public function destroyTerm($id)
    {
        $cicloEscolar = Term::find($id);

        if (!$cicloEscolar) {
            return response()->json(['mensaje' => 'Ciclo escolar no encontrado'], 404);
        }
        $cicloEscolar->delete();

        return response()->json(['mensaje' => 'Ciclo escolar eliminado correctamente'], 200);
    }

    public function getTerm($id)
    {
        $cicloEscolar = Term::find($id);
        if (!$cicloEscolar) {
            return response()->json(['mensaje' => 'Ciclo escolar no encontrado'], 404);
        }
        return response()->json(['ciclo_escolar' => $cicloEscolar], 200);
    }

    public function getProgramID($id)
    {
        $programID = Program::find($id);
        return $programID;
    }
}
