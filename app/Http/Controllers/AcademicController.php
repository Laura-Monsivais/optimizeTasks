<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use App\Models\ClassLevel;
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

        return response()->json(['mensaje' => 'El ciclo se actualizado correctamente', 'term' => $term], 200);
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

        return response()->json(['mensaje' => 'El grupo ha sido actualizado correctamente', 'group' => $group], 200);
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
    
    public function createPrograms(Request $request)
    {
        $nivel = $request->input('Name');
        $createdPrograms = [];
    
        $programData = [
            'Kinder' => 'KN',
            'Primaria' => 'PRIM',
            'Secundaria' => 'SEC',
            'Bachillerato' => 'BACH',
            'Universidad' => 'UNIV',
        ];
    
        $foundProgram = false;
    
        foreach ($programData as $programName => $short) {
            $programInitial = strtolower(substr($programName, 0, 1));
            if (strpos(strtolower($nivel), $programInitial) !== false) {
                $foundProgram = true;
                ClassLevel::where('Name', 'like', "%$programInitial%")->update(['Visible' => 1]);
            } else {
                ClassLevel::where('Name', 'like', "%$programInitial%")->update(['Visible' => 0]);
            }
        }
    
        if (!$foundProgram) {
            throw new \InvalidArgumentException("Programa no válido: $nivel");
        }
    
        foreach ($programData as $name => $short) {
            if ($name == $nivel || $short === null) {
                break;
            }
    
            $createdProgram = Program::create([
                'Name' => $name,
                'Short' => $short,
            ]);
    
            $createdPrograms[] = $createdProgram;
        }
    
        $program = Program::create([
            'Name' => $request->input('Name'),
            'Short' => $request->input('Short'),
        ]);
    
        $createdPrograms[] = $program;
    
        return response()->json([
            'mensaje' => 'El programa ha sido creado correctamente',
            'programas_creados' => $createdPrograms
        ], 201);
    }

    public function updateProgram(Request $request, $id)
    {
    $program = Program::find($id);

    if (!$program) {
        return response()->json(['mensaje' => 'Programa no encontrado'], 404);
    }
    $program->update([
        'Name' => $request->input('Name'),
        'Short' => $request->input('Short'),
    ]);
    
    return response()->json(['mensaje'=>'El programa se ha actualizado correctamente','program'=>$program],200);

    }

    public function destroyProgram($id)
    {
    $program = Program::find($id);

    if (!$program) {
        return response()->json(['mensaje' => 'Programa no encontrado'], 404);
    }
    $program->delete();

    return response()->json(['mensaje' => 'El programa ha sido eliminado correctamente'], 200);
    }

}
