<?php

namespace App\Http\Controllers;
use App\Models\Academic;
use App\Models\Group;
use App\Models\Program;
use App\Models\Term;
use Illuminate\Http\Request;

class AcademicController extends Controller
{

    /* Crear la migracion, modelo, rutas y funciones*/
    public function createTerm(Request $request)
    {
        
        // Crea un nuevo ciclo escolar
        $term = Term::create([
            'Name' => $request->input('Name'),
            'StartDate' => $request->input('NameStart'),
            'EndDate' => $request->input('NameEnd'),
        ]);

        return response()->json(['mensaje' => 'Ciclo creado correctamente', 'term
        ' => $term], 201);
    }

    public function updateTerm(Request $request, $id)
    {
        $term = Term::find($id);

        if (!$term) {
            return response()->json(['mensaje' => 'Ciclo escolar no encontrado'], 404);
        }
        $term->update([
            'Name' => $request->input('Name'),
            'StartDate' => $request->input('NameStart'),
            'EndDate' => $request->input('EndDate'),
        ]);
        
    return response()->json(['mensaje'=>'El ciclo se actualizado correctamente','term'=>$term],200);
    
    }

    public function destroyTerm($id)
    {
        $term = Term::find($id);

        if (!$term) {
            return response()->json(['mensaje' => 'Ciclo escolar no encontrado'], 404);
        }
        $term->delete();

        return response()->json(['mensaje' => 'Ciclo escolar eliminado correctamente'], 200);
    }

    public function getTerm($id)
    {
        $term = Term::find($id);
        if (!$term) {
            return response()->json(['mensaje' => 'Ciclo escolar no encontrado'], 404);
        }
        return response()->json(['term' => $term], 200);
    }

    public function getProgramID($id)
    {
        $programID = Program::find($id);
        return $programID;
    }

    public function createGroup(Request $request)
    {
        // Crea un nuevo ciclo escolar
        $group = Group::create([
            'Name' => $request->input('Name'),
            'ProgramShiftID' => 1,
            'TermID' => $request->input('TermID'),
            'ProgramID' => $request->input('ProgramID'),
            'ClassLevelID' => $request->input('ClassLevelID'),
            'Owner_CID' => 0,
        ]);

        return response()->json(['mensaje' => 'El grupo ha sido creado correctamente', 'group
        ' => $group], 201);
    }

    public function updateGroup(Request $request, $id)
    {
        $group = Group::find($id);

        if (!$group) {
            return response()->json(['mensaje' => 'Grupo no encontrado'], 404);
        }
        $group->update([
            'Name' => $request->input('Name'),
            'ProgramShiftID' => 1,
            'TermID' => $request->input('TermID'),
            'ProgramID' => $request->input('ProgramID'),
            'ClassLevelID' => $request->input('ClassLevelID'),
            'Owner_CID' => 0,
        ]);
        
    return response()->json(['mensaje'=>'El grupo ha sido actualizado correctamente','group'=>$group],200);
    
    }

    public function destroyGroup($id)
    {
        $group = Group::find($id);

        if (!$group) {
            return response()->json(['mensaje' => 'Grupo no encontrado'], 404);
        }
        $group->delete();

        return response()->json(['mensaje' => 'El grupo ha sido eliminado correctamente'], 200);
    }

    public function getGroup($id)
    {
        $group = Group::find($id);
        if (!$group) {
            return response()->json(['mensaje' => 'Grupo no encontrado'], 404);
        }
        return response()->json(['group' => $group], 200);
    }
}
