<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $Student = Students::all();
        return $Student;
        //return response()->json( $family );//
    }

    public function getProgramID($id)
    {
        $programID = Program::find($id);
        return $programID;
    }

    public function registerStudents(Request $request)
    {

        $request->validate([
            'Name' => 'required',
            'Last' => 'required',
            'CURP' =>'CURP',
            'Phone1' => 'max:10'
        ]);

        Students::create(
            [
                'Name' => $request->input('Name'),
                'Last' => $request->input('Last'),
                'CURP' => $request->input('CURP'),
                'Phone1' => $request->input('Phone1')
            ]
        );
        return response()->json(['El alumno se agrego exitosamente'],200);
    }

  
}
