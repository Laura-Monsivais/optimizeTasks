<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use App\Models\Persons;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Family;
use App\Models\State;
use App\Models\Students;
use Faker\Core\Number;
use Illuminate\Support\Facades\Validator;


class PersonsController extends Controller
{
    public function index()
    {
        $persons = Persons::all();
        return $persons;
        //return response()->json( $family );//
    }

    public function store(Request $request, $ID)
    {

        $Persons = Persons::find($ID);
        // Verificar si la persona ya tiene un ID de familia
        if ($Persons->ID === null) {      // Crear una nueva familia utilizando los apellidos de la persona
            $Persons->Name = $request->input('Name');
            $Persons->Last = $request->input('Last');
            $Persons->Last2 = $request->input('Last2');
            $Persons->curp = $request->input('curp');
            $Persons->Gender = $this->validateGender($request->input('curp'));
            $Persons->BirthDate = $request->input('BirthDate');
            $Persons->BirthPlaceID = $request->input('BirthPlaceID');
            $Persons->BirthCity = $request->input('BirthCity');
            $Persons->CellPhone = $request->input('CellPhone');
            $Persons->PrimaryEmail = $request->input('PrimaryEmail');
            $Persons->MaritalStatusID = $request->input('MaritalStatusID');
            $Persons->WorkPlace = $request->input('WorkPlace');
            $Persons->WorkJob = $request->input('WorkJob');

            return "";
        } else {
            return "Ya existe un alumno con esa ID";
        }

        return response()->json(['La persona se agrego exitosamente'], 200);
    }

    public function validateCurp(Request $request)
    {
        $curp = trim($request->input('curp'));

        // Verificar la longitud de CURP
        if (strlen($curp) !== 18) {
            return response()->json(['error' => 'Tamaño Incorrecto de la CURP'], 400);
        }

        // Patrón de CURP
        $curpPattern = '/^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z]\d$/';

        // Verificar el formato de CURP
        if (!preg_match($curpPattern, $curp)) {
            return response()->json(['error' => 'Formato Incorrecto de la CURP'], 400);
        }

        // Calcular el dígito verificador
        $sum = 0;
        $characters = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
        $diccionary = array_flip(str_split($characters));

        for ($i = 0; $i < 18; $i++) {
            $value = $diccionary[$curp[$i]];
            $sum += ($i < 17) ? $value * (18 - $i) : 10 - $sum % 10;
        }

        // Verificar el dígito verificador
        $valid = (int)$curp[17] === $sum % 10;

        return response()->json(['valido' => $valid]);
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
}
