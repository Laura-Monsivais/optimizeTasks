<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{

    /* Ver todas las familias */
    public function index(Request $request)
    {
    }

    /* Crear nueva familia (opción para alumnos que vengan sin ID de familia) */
    public function store(Request $request)
    {
    }
    
    /* Obtener StateID (ID del estado) */
    public function getStateID(Request $request)
    {
    }

    /* Obtener CountryID (ID del estado) */
    public function getCountryID(Request $request)
    {
    }

    /* Separar dirección */
    public function separateAddress(Request $request)
    {
        /* Manejar estos campos con los del SKEL (suplirlos) */
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
        /* Imprimir en inglés con los campos del SKEL */
        return response()->json([
            'calle' => $calle,
            'numero_interior' => $numeroInterior,
            'numero_exterior' => $numeroExterior,
            'colonia' => $colonia,
        ]);
    }

    /* Separar apellidos  (LAURA)*/
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
        /* Modificarlo a campos de SKEL y revisar validaciones que falten */
        return response()->json([
            'paternalSurname' => $paternalSurname,
            'maternalSurname' => $maternalSurname
        ]);
    }

    /* Validar Genero */
    public function Gender(Request $request)
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

    /* Validar Teléfono */
    public function validatePhone(Request $request)
    {
        /* Falta quitar espacios en blanco, falta sustituir caracteres como "-",
        Solicitar una LADA y agregarla en caso de que el número sea menor a 8 digitos,
        validar que sea a 10 Digitos, si es mayor a 10 no se considera */
        $rules = [
            'number' => 'required',
        ];

        $messages = [
            'number.digits' => 'El número de teléfono debe tener exactamente 10 dígitos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        /* Regresar el número */
        return redirect()->back()->with('success', 'Número de teléfono válido.');
    }
}
