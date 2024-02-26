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

    public function store(Request $request, $ID)
    {
        $student = Students::find($ID);
        if ($student->FamilyID === null) {
            // Crear una nueva familia utilizando los apellidos del alumno
            $Family = new Family();
            $Family->LastName1 = $student->LastName1;
            $Family->LastName2 = $student->LastName2;
            $Family->save();
            
            $student->FamilyID = $Family->ID;
            $student->save();
            return "Se ha creado una nueva familia para el alumno.";
        } else {
            return "El alumno ya tiene asignado un ID de familia.";
        }

    }

    public function verificationFamID(Request $request)
    {
    $IDStudents = $request->input('students');
    $StudentsFam = Students::whereIn('ID', $IDStudents)->whereNotNull('FamilyID')->exists();

    if ($StudentsFam) {
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
        
        $address = $request->input('address');
        $calle = 'Address1';
        $numeroInterior = 'IntNum';
        $numeroExterior = 'ExtNum';
        $colonia = 'Address2';
                
        // Separar la dirección por espacios
        $addressParts = explode(' ', $address);

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
    public function validateNumber(Request $request)
{
    $rules = [
        'number' => 'required|numeric',
    ];

    $messages = [
        'number.required' => 'El número de teléfono es obligatorio.',
        'number.numeric' => 'El número de teléfono debe ser un valor numérico.',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $numero = $request->input('number');

    $numero = preg_replace("/[^0-9]/", "", $numero);

    $lada = $request->input('lada');
    if (strlen($numero) < 8 && is_numeric($lada)) {
        $numero = $lada . $numero;
    }

    if (strlen($numero) !== 10) {
         return redirect()->back()->withErrors(['number' => 'Deben de ser 10 numeros'])->withInput();
    }

    if (strlen($numero) < 10) {
        return redirect()->back()->withErrors(['number' => 'Número de teléfono inválido.'])->withInput();
    }
    return redirect()->back()->with('success', 'Número de teléfono válido: ' . $numero);
}
}
