<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use App\Models\Persons;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    public function index()
    {
        $persons = Persons::all();
        return $persons;
        //return response()->json( $family );//
    }

    public function registerPersons(Request $request)
    {

        $request->validate([
            'Name' => 'required',
            'Last' => 'required',
            'CURP' =>'CURP',
            'Phone1' => 'max:10'
        ]);

        Persons::create(
            [
                'Name' => $request->input('Name'),
                'Last' => $request->input('Last'),
                'CURP' => $request->input('CURP'),
                'Phone1' => $request->input('Phone1')
            ]
        );
        return response()->json(['La persona se agrego exitosamente'],200);
    }

    public function PersonsCurp(Request $request)
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
    $suma = 0;
    $caracteres = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    $diccionario = array_flip(str_split($caracteres));

    for ($i = 0; $i < 18; $i++) {
        $valor = $diccionario[$curp[$i]];
        $suma += ($i < 17) ? $valor * (18 - $i) : 10 - $suma % 10;
    }

    // Verificar el dígito verificador
    $valid = (int)$curp[17] === $suma % 10;

    return response()->json(['valido' => $valid]);
    }

    public function PersonsGender(Request $request)
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
}
