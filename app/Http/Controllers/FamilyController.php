<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Family;
use App\Models\State;
use App\Models\Students;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{

    /* Ver todas las familias */
    public function index(Request $request)
    {
        $family = Family::all();
        return response()->json( $family );
    }

    /* Crear nueva familia (opción para alumnos que vengan sin ID de familia) */
    public function store(Request $request)
    {
    $IDStudents = $request->input('students');

    $alumnosConFamilia = Students::whereIn('ID', $IDStudents)->whereNotNull('FamilyID')->exists();

    if ($alumnosConFamilia) {
        return response()->json(['mensaje' => 'El alumnos ya tienen una familia.'], 422);
    }
    $NewFamily = Students::create();

    Students::whereIn('ID', $IDStudents)->update(['FamilyID' => $NewFamily->id]);

    return response()->json(['mensaje' => 'Nueva familia creada con éxito.']);

    }
    
    /* Obtener StateID (ID del estado) */
    public function getStateID(Request $request, $ID)
    {
        $ID = $request->input('ID');

        // Verifica si el ID es válido
        if (!$ID) {
            return response()->json(['mensaje' => 'ID no proporcionado en la solicitud'], 400);
        }
        $state = State::find($ID);
    
        if ($state) {
            return response()->json(['StateID' => $state->ID]);
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }

    /* Obtener CountryID (ID del estado) */
    public function getCountryID(Request $request,$ID)
    {
        $ID = $request->input('ID');

        // Verifica si el ID es válido
        if (!$ID) {
            return response()->json(['mensaje' => 'ID no proporcionado en la solicitud'], 400);
        }
        $Country = Country::find($ID);
    
        if ($Country) {
            return response()->json(['CountryID' => $Country->ID]);
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
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

        $numero = $request->input('numero');
        $Number = str_replace(' ', '', $numero);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        /* Regresar el número */
        return redirect()->back()->with('success', 'Número de teléfono válido.');
    }
}
