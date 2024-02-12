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
    
    public function validateCURP(Request $request)
    {
        /* Cambiar el código a inglés */
        $curp = $request->input('curp');

        if (strlen($curp) !== 18) {
            return response()->json(['error' => 'Longitud de CURP incorrecta'], 400);
        }
        $patronCurp = '/^[A-Z]{4}\d{6}[HM][A-Z]{5}\d{2}$/';
        if (!preg_match($patronCurp, $curp)) {
            return response()->json(['error' => 'Formato de CURP incorrecto'], 400);
        }

        $suma = 0;
        $caracteres = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
        $diccionario = array_flip(str_split($caracteres));

        for ($i = 0; $i < 18; $i++) {
            $valor = $diccionario[$curp[$i]];
            if ($i < 17) {
                $suma += $valor * (18 - $i);
            } else {
                $digitoVerificador = 10 - $suma % 10;
            }
        }

        return response()->json(['valid' => (int)$curp[17] === $digitoVerificador]);
    }
  
}
