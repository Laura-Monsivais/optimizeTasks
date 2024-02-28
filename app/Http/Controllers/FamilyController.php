<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Family;
use App\Models\State;
use App\Models\Students;
use App\Models\TemporaryTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{

    /* Ver todas las familias */
    public function index(Request $request)
    {
        $family = Family::all();
        return response()->json($family);
    }

    /* Crear nueva familia (opción para alumnos que vengan sin ID de familia) */
    public function store($studentId)
    {
        $student = Students::find($studentId);
        if (!$student) {
            return "El alumno no existe.";
        }

        if (!$student->FamilyID) {
            // Crear una nueva familia utilizando los apellidos del alumno
            $family = new Family();
            $family->LastName1 = $student->Last;
            $family->LastName2 = $student->Last2;

            try {
                $family->save();
                $student->FamilyID = $family->ID;
                $student->save();
                return response()->json(['success' => 'Se ha creado una nueva familia para el alumno.'], 200);
            } catch (\Exception $e) {
                return "Error al crear la familia: " . $e->getMessage();
            }
        } else {
            return response()->json(['error' => 'El alumno ya tiene asignado un ID de familia.'], 422);
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
    public function getStateID($stateID)
    {
        // Verifica si el ID es válido
        if (!$stateID) {
            return response()->json(['mensaje' => 'ID no proporcionado en la solicitud'], 400);
        }
        $state = State::find($stateID);

        if ($state) {
            return response()->json(['StateID' => $state->Name]);
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }

    /* Obtener CountryID (ID del estado) */
    public function getCountryID($CountryID)
    {
        // Verifica si el ID es válido
        if (!$CountryID) {
            return response()->json(['mensaje' => 'ID no proporcionado en la solicitud'], 400);
        }
        $Country = Country::find($CountryID);

        if ($Country) {
            return response()->json(['CountryID' => $Country->Name]);
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }

    /* Separar dirección */
    public function separateAddress(Request $request)
    {
    $address = $request->input('address');
    $street = 'Address1';
    $interiorNumber = 'IntNum';
    $exteriorNumber = 'ExtNum';
    $suburb = 'Address2';

    // Separar la dirección por espacios
    $addressParts = explode(' ', $address);

    foreach ($addressParts as $key => $part) {
        // Verificar si la parte actual es numérica
        if (is_numeric($part) || (preg_match('/^\d+[a-zA-Z]*$/', $part))) {
            // Si hay otra parte numérica o alfanumérica siguiente, considerarla como número interior
            if (isset($addressParts[$key + 1]) && (is_numeric($addressParts[$key + 1]) || preg_match('/^\d+[a-zA-Z]*$/', $addressParts[$key + 1]))) {
                $interiorNumber = $part;
                $exteriorNumber = $addressParts[$key + 1];
            } else {
                // Si solo hay una parte numérica o alfanumérica, considerarla como número exterior
                $exteriorNumber = $part;
                // Verificar si hay una indicación de número interior
                if (isset($addressParts[$key + 1]) && preg_match('/^Int$/i', $addressParts[$key + 1])) {
                    $interiorNumber = $addressParts[$key + 2];
                    $key += 2; // Saltar la parte de 'Int' y el número interior
                }
            }
            // Las partes anteriores a la parte numérica o alfanumérica son la calle
            $street = implode(' ', array_slice($addressParts, 0, $key));
            // Las partes posteriores a la parte numérica o alfanumérica son la colonia
            $suburb = implode(' ', array_slice($addressParts, $key + 2));
            break;
        }
    }

    // Imprimir en inglés con los campos del SKEL
    return response()->json([
        'calle' => $street,
        'numero_interior' => $interiorNumber,
        'numero_exterior' => $exteriorNumber,
        'colonia' => $suburb,
    ]);
    }

    /* Separar apellidos  (LAURA)*/
    public function separateSurnames(Request $request)
    {
        $columnData = $request->input('columnData');
    
        foreach ($columnData as $index => $fullName) {
            $words = explode(' ', $fullName);
            $paternalSurname = array_shift($words);
            $maternalSurname = implode(' ', $words);

            $data = TemporaryTable::find($index + 1); 
    
            if ($data) {
                $jsonData = json_decode($data->data, true);
                $jsonData['paternalSurname'] = $paternalSurname;
                $jsonData['maternalSurname'] = $maternalSurname;
                $data->data = json_encode($jsonData);
                $data->save();
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Apellidos separados actualizados correctamente en la tabla temporal.'
        ]);
    }

    /* Validar Teléfono */
    public function validateNumber(Request $request)
    {

        /* Falta eliminar espacios u otro caracter (-)*/
        $rules = [
            'number' => 'required|numeric',
        ];

        $messages = [
            'number.required' => 'El número de teléfono es obligatorio.',
            'number.numeric' => 'El número de teléfono debe ser un valor numérico.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator], 404);
        }
        $number = $request->input('number');
        $number = preg_replace("/[^0-9]/", "", $number);
        $number = str_replace(' ', '', $number);

        $lada = $request->input('lada');
        if (strlen($number) < 8 && is_numeric($lada)) {
            $number = $lada . $number;
        }

        if (strlen($number) !== 10) {
            return response()->json(['error' => 'Deben de ser 10 numeros'], 404);
        }

        if (strlen($number) < 10) {
            return response()->json(['error' => 'Número de teléfono inválido.'], 404);
        }

        return response()->json(['success' => 'Número de teléfono válido: ' . $number], 200); 
    }
}
