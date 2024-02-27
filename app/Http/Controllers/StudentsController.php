<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Place;
use App\Models\Religion;

class StudentsController extends Controller
{
    public function index()
    {
        $Student = Students::all();
        return $Student;
        //return response()->json( $family );//
    }

    public function store(Request $request, $ID)
    {
        $student = Students::find($ID);
        // Verificar si el alumno no tiene un id Principal
        if ($student->ID === null) {
            // Crear una nueva familia utilizando los apellidos del alumno
            $student->Name = $request->input('Name');
            $student->Last = $request->input('Last');
            $student->Last2 = $request->input('Last2');
            $student->curp = $request->input('curp');
            $student->Gender = $this->validateGender($request->input('curp'));
            $student->MaritalStatusID = $request->input('MaritalStatusID');
            $student->BirthDate = $request->input('BirthDate');
            $student->BirthCity = $request->input('BirthCity');
            $student->BirthPlaceID = $request->input('BirthPlaceID');
            $student->NationalityID = $request->input('NationalityID');
            $student->ReligionID = $request->input('CellPhone');
            $student->PrimaryEMail = $request->input('PrimaryEMail');
            $student->ProgramID = $request->input('ProgramID');
            $student->ReligionID = $request->input('TermID');
            $student->PrimaryEMail = $request->input('ClassLevelID');
            $student->ProgramID = $request->input('GroupID');
            return "Se un nuevo alumno.";
        } else {
            return "El alumno ya existe.";
        }
        return response()->json(['El alumno se agrego exitosamente'], 200);
    }

    public function validateCurp($curp_)
    {
        /* Cambiar el código a inglés */
        $curp = $curp_;
        if (strlen($curp) > 18) {
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

    public function validateGender(Request $request)
    {
        $curp = $request->input('curp');

        if (strlen($curp) < 18) {
            return "CURP no válida";
        }

        $sexo = strtoupper($curp[10]);

        // Determinar el sexo
        if ($sexo == 'H') {
            return "M";
        } elseif ($sexo == 'M') {
            return "F";
        }
    }

    public function getProgramID($id)
    {
        $programID = Program::find($id);
        return $programID;
    }

    public function getMaritalStatusID($id)
    {
        $MaritalStatusID = MaritalStatus::find($id);
        return $MaritalStatusID;
    }

    public function BirthPlaceID($id)
    {
        $BirthPlaceID = Place::find($id);
        return $BirthPlaceID;
    }

    public function NationalityID($id)
    {
        $NationalityID = Nationality::find($id);
        return $NationalityID;
    }

    public function ReligionID($id)
    {
        $ReligionID = Religion::find($id);
        return $ReligionID;
    }
}
