<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Place;
use App\Models\Religion;
use App\Models\TemporaryTable;

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

    public function separateFullName(Request $request)
    {
        $columnData = $request->input('columnData');
        $namesWithSurnames = [];
    
        foreach ($columnData as $fullName) {
            if (!empty($fullName)) {
                $separatedNames = $this->separate($fullName);
                $namesWithSurnames[] = $separatedNames;
            }
        }
        $records = TemporaryTable::all();
    
        foreach ($records as $key => $record) {
            if (isset($namesWithSurnames[$key])) {
                $recordData = json_decode($record->data, true);
    
                $recordData['Last (alumnos)'] = $namesWithSurnames[$key]['Last (alumnos)'];
                $recordData['Last2 (alumnos)'] = $namesWithSurnames[$key]['Last2 (alumnos)'];
                $recordData['Name (alumnos)'] = $namesWithSurnames[$key]['Name (alumnos)'];
                $record->update(['data' => json_encode($recordData)]);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Nombre completo separado correctamente.',
            'namesWithSurnames' => $namesWithSurnames
        ]);
    }
    
    public static function separate($fullName, $firstName = false){
        $chunks = ($firstName)
            ? explode(" ", strtoupper($fullName))
            : array_reverse(explode(" ", strtoupper($fullName)));
        $exceptions = ["DE", "LA", "DEL", "LOS", "SAN", "SANTA"];
        $exist = array_intersect($chunks, $exceptions);
        $name = array( "Last2 (alumnos)" => "", "Last (alumnos)" => "", "Name (alumnos)" => "" );
        $add = ($firstName)
            ? "paterno"
            : "materno";
        $first_time = true;
        if($firstName){
            if(!empty($exist)){
                foreach ($chunks as $chunk) {
                    if($first_time){
                        $name["Last (alumnos)"] = $name["Last (alumnos)"] . " " . $chunk;
                        $first_time = false;
                    }else{
                        if(in_array($chunk, $exceptions)){
                            if($add == "paterno")
                                $name["Last (alumnos)"] = $name["Last (alumnos)"] . " " . $chunk;
                            elseif($add == "materno")
                                $name["Last2 (alumnos)"] = $name["Last2 (alumnos)"] . " " . $chunk;
                            else
                                $name["Name (alumnos)"] = $name["Name (alumnos)"] . " " . $chunk;
                        }else{
                            if($add == "paterno"){
                                $name["Last (alumnos)"] = $name["Last (alumnos)"] . " " . $chunk;
                                $add = "materno";
                            }elseif($add == "materno"){
                                $name["Last2 (alumnos)"] = $name["Last2 (alumnos)"] . " " . $chunk;
                                $add = "nombres";
                            }else{
                                $name["Name (alumnos)"] = $name["Name (alumnos)"] . " " . $chunk;
                            }
                        }
                    }
                }
            }else{
                foreach ($chunks as $chunk) {
                    if($first_time){
                        $name["Last (alumnos)"] = $name["Last (alumnos)"] . " " . $chunk;
                        $first_time = false;
                    }else{
                        if(in_array($chunk, $exceptions)){
                            if($add == "paterno")
                                $name["Last (alumnos)"] = $name["Last (alumnos)"] . " " . $chunk;
                            elseif($add == "materno")
                                $name["Last2 (alumnos)"] = $name["Last2 (alumnos)"] . " " . $chunk;
                            else
                                $name["Name (alumnos)"] = $name["Name (alumnos)"] . " " . $chunk;
                        }else{
                            if($add == "paterno"){
                                $name["Last2 (alumnos)"] = $name["Last2 (alumnos)"] . " " . $chunk;
                                $add = "materno";
                            }elseif($add == "materno"){
                                $name["Name (alumnos)"] = $name["Name (alumnos)"] . " " . $chunk;
                                $add = "nombres";
                            }else{
                                $name["Name (alumnos)"] = $name["Name (alumnos)"] . " " . $chunk;
                            }
                        }
                    }
                }
            }
        }else{
            foreach($chunks as $chunk){
                if($first_time){
                    $name["Last2 (alumnos)"] = $chunk . " " . $name["Last2 (alumnos)"];
                    $first_time = false;
                }else{
                    if(in_array($chunk, $exceptions)){
                        if($add == "materno")
                            $name["Last2 (alumnos)"] = $chunk . " " . $name["Last2 (alumnos)"];
                        elseif($add == "paterno")
                            $name["Last (alumnos)"] = $chunk . " " . $name["Last (alumnos)"];
                        else
                            $name["Name (alumnos)"] = $chunk . " " . $name["Name (alumnos)"];
                    }else{
                        if($add == "materno"){
                            $add = "paterno";
                            $name["Last (alumnos)"] = $chunk . " " . $name["Last (alumnos)"];
                        }elseif($add == "paterno"){
                            $add = "nombres";
                            $name["Name (alumnos)"] = $chunk . " " . $name["Name (alumnos)"];
                        }else{
                            $name["Name (alumnos)"] = $chunk . " " . $name["Name (alumnos)"];
                        }
                    }
                }
            }
        }
        // LIMPIEZA DE ESPACIOS
        $name["Last2 (alumnos)"] = trim($name["Last2 (alumnos)"]);
        $name["Last (alumnos)"] = trim($name["Last (alumnos)"]);
        $name["Name (alumnos)"] = trim($name["Name (alumnos)"]);
        return $name;
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

        $sum = 0;
        $characters = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
        $diccionary = array_flip(str_split($characters));

        for ($i = 0; $i < 18; $i++) {
            $value = $diccionary[$curp[$i]];
            if ($i < 17) {
                $sum += $value * (18 - $i);
            } else {
                $valid = 10 - $sum % 10;
            }
        }

        return response()->json(['valid' => (int)$curp[17] === $valid]);
    }

    public function validateGender(Request $request)
    {
        $curp = $request->input('curp');

        if (strlen($curp) < 18) {
            return "CURP no válida";
        }

        $gender = strtoupper($curp[10]);

        // Determinar el sexo
        if ($gender == 'H') {
            return "M";
        } elseif ($gender == 'M') {
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
