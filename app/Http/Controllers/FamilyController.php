<?php

namespace App\Http\Controllers;

use App\Imports\ImportClass;
use App\Models\Family;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Artisan;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{

    public function showImport()
    {
        return view('import');
    }

    public function uploadImport(Request $request)
    {
        Excel::import(new ImportClass, $request->file('excel_file')->store('import_files'));
        return back();
    }


    public function separateAddress(Request $request)
    {
        $address = $request->input('address');
        $calle = '';
        $numeroInterior = '';
        $numeroExterior = '';
        $colonia = '';
    
        // Separar la dirección por espacios
        $addressParts = explode(' ', $address);
    
        // Iterar sobre las partes de la dirección
        foreach ($addressParts as $key => $part) {
            // Verificar si la parte actual es numérica
            if (is_numeric($part)) {
                // Si hay otra parte numérica siguiente, considerarla como número interior
                if (isset($addressParts[$key + 1]) && is_numeric($addressParts[$key + 1])) {
                    $numeroInterior = $part;
                    $numeroExterior = $addressParts[$key + 1];
                } else {
                    // Si solo hay una parte numérica, considerarla como número exterior
                    $numeroExterior = $part;
                    // Verificar si hay una indicación de número interior
                    if (isset($addressParts[$key + 1]) && preg_match('/^Int$/i', $addressParts[$key + 1])) {
                        $numeroInterior = $addressParts[$key + 2];
                        $key += 2; // Saltar la parte de 'Int' y el número interior
                    }
                }
                // Las partes anteriores a la parte numérica son la calle
                $calle = implode(' ', array_slice($addressParts, 0, $key));
                // Las partes posteriores a la parte numérica son la colonia
                $colonia = implode(' ', array_slice($addressParts, $key + 2));
                break;
            }
        }
    
        return response()->json([
            'calle' => $calle,
            'numero_interior' => $numeroInterior,
            'numero_exterior' => $numeroExterior,
            'colonia' => $colonia,
        ]);
    }
    /* Separar apellidos */
public function separateSurnames(Request $request)
    {
        $fullName = $request->input('fullName');
        $words = explode(' ', $fullName);
        if (count($words) > 1) {
            $maternalSurname = array_pop($words);
            $possibleUnions = ['DEL', 'DE LA', 'DE', 'A'];
            $unionPhrase = '';
            while (in_array(strtoupper($unionPhrase . $maternalSurname), $possibleUnions) && count($words) > 0) {
                $unionPhrase .= array_pop($words) . ' ';
                $maternalSurname = $unionPhrase . $maternalSurname;
            }
            $paternalSurname = implode(' ', $words);
        } else {
            $paternalSurname = $fullName;
            $maternalSurname = null;
        }
        return response()->json([
            'paternalSurname' => $paternalSurname,
            'maternalSurname' => $maternalSurname
        ]);
    }

    /* Validar CURP */
    public function validateCURP(Request $request) {
        // Obtener la CURP desde la variable de la solicitud
        $curp = $request->input('curp');
    
        // Verificar que la longitud de la CURP sea correcta
        if (strlen($curp) !== 18) {
            return response()->json(['error' => 'Longitud de CURP incorrecta'], 400);
        }
    
        // Verificar el formato de la CURP con una expresión regular
        $patronCurp = '/^[A-Z]{4}\d{6}[HM][A-Z]{5}\d{2}$/';
        if (!preg_match($patronCurp, $curp)) {
            return response()->json(['error' => 'Formato de CURP incorrecto'], 400);
        }
    
        // Verificar la homoclave utilizando el algoritmo oficial
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
    
        // Devolver la respuesta fuera del bucle
        return response()->json(['valid' => (int)$curp[17] === $digitoVerificador]);
    }

    public function Gender(Request $request)
    {
        $curp = $request->input('curp');

        // Verificar que la CURP tiene al menos 18 caracteres
        if (strlen($curp) < 18) {
            return "CURP no válida";
        }

        // Obtener la séptima letra de la CURP
        $sexo = strtoupper($curp[10]);
 
        // Determinar el sexo
        if ($sexo == 'H') {
            return "Masculino";
        } elseif ($sexo == 'M') {
            return "Femenino";
        }
    }

    public function validarNumeroTelefono(Request $request)
    {
        $rules = [
            'number' => 'required|digits:10',
        ];

        $messages = [
            'number.digits' => 'El número de teléfono debe tener exactamente 10 dígitos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return redirect()->back()->with('success', 'Número de teléfono válido.');
    }

    

    public function NamesOrder(Request $request)
    {
        $nombreCompleto = $request->input('nombre');

        // Divide el nombre completo en partes: nombres, apellidos
        $partes = explode(" ", $nombreCompleto);

        // Asegúrate de que haya al menos un nombre y dos apellidos
        $nombres = isset($partes[0]) ? $partes[0] : '';
        $apellidoPaterno = isset($partes[1]) ? $partes[1] : '';
        $apellidoMaterno = isset($partes[2]) ? $partes[2] : '';

        return view('resultado', [
            'nombres' => $nombres,
            'apellidoPaterno' => $apellidoPaterno,
            'apellidoMaterno' => $apellidoMaterno,
        ]);
    }
    public function LastNames($nombreCompleto) {
        // Dividir el nombre completo en partes (nombres y apellidos)
        $partes = explode(" ", $nombreCompleto);
        
        // Obtener el número total de partes
        $numPartes = count($partes);
        
        // Si hay menos de 2 partes, no hay suficientes apellidos para extraer
        if ($numPartes < 3) {
            return "No hay suficientes apellidos para extraer";
        }
        
        // Obtener los dos últimos elementos del array (últimos dos apellidos)
        $ultimosApellidos = array_slice($partes, -2);
        
        // Unir los últimos dos apellidos en un string
        $apellidos = implode(" ", $ultimosApellidos);
        
        return $apellidos;
    }
    
}