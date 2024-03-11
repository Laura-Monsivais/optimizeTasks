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

    public function separateSurnames(Request $request)
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

                $recordData['LastName1 (Familias)'] = $namesWithSurnames[$key]['LastName1 (Familias)'];
                $recordData['LastName2 (Familias)'] = $namesWithSurnames[$key]['LastName2 (Familias)'];
                $record->update(['data' => json_encode($recordData)]);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Nombres y apellidos separados actualizados correctamente.',
            'namesWithSurnames' => $namesWithSurnames
        ]);
    }

    public static function separate($fullName, $firstName = false)
    {
        $chunks = ($firstName)
            ? explode(" ", strtoupper($fullName))
            : array_reverse(explode(" ", strtoupper($fullName)));
        $exceptions = ["DE", "LA", "DEL", "LOS", "SAN", "SANTA"];
        $exist = array_intersect($chunks, $exceptions);
        $name = array("LastName2 (Familias)" => "", "LastName1 (Familias)" => "");
        $add = ($firstName)
            ? "paterno"
            : "materno";
        $first_time = true;
        if ($firstName) {
            if (!empty($exist)) {
                foreach ($chunks as $chunk) {
                    if ($first_time) {
                        $name["LastName1 (Familias)"] = $name["LastName1 (Familias)"] . " " . $chunk;
                        $first_time = false;
                    } else {
                        if (in_array($chunk, $exceptions)) {
                            if ($add == "paterno") {
                                $name["LastName1 (Familias)"] = $name["LastName1 (Familias)"] . " " . $chunk;
                            } else {
                                $name["LastName2 (Familias)"] = $name["LastName2 (Familias)"] . " " . $chunk;
                            }
                        } else {
                            if ($add == "paterno") {
                                $name["LastName1 (Familias)"] = $name["LastName1 (Familias)"] . " " . $chunk;
                                $add = "materno";
                            } else {
                                $name["LastName2 (Familias)"] = $name["LastName2 (Familias)"] . " " . $chunk;
                                $add = "nombres";
                            }
                        }
                    }
                }
            } else {
                foreach ($chunks as $chunk) {
                    if ($first_time) {
                        $name["LastName1 (Familias)"] = $name["LastName1 (Familias)"] . " " . $chunk;
                        $first_time = false;
                    } else {
                        if (in_array($chunk, $exceptions)) {
                            if ($add == "paterno") {
                                $name["LastName1 (Familias)"] = $name["LastName1 (Familias)"] . " " . $chunk;
                            } else {
                                $name["LastName2 (Familias)"] = $name["LastName2 (Familias)"] . " " . $chunk;
                            }
                        } else {
                            if ($add == "paterno") {
                                $name["LastName2 (Familias)"] = $name["LastName2 (Familias)"] . " " . $chunk;
                                $add = "materno";
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($chunks as $chunk) {
                if ($first_time) {
                    $name["LastName2 (Familias)"] = $chunk . " " . $name["LastName2 (Familias)"];
                    $first_time = false;
                } else {
                    if (in_array($chunk, $exceptions)) {
                        if ($add == "materno") {
                            $name["LastName2 (Familias)"] = $chunk . " " . $name["LastName2 (Familias)"];
                        } elseif ($add == "paterno") {
                            $name["LastName1 (Familias)"] = $chunk . " " . $name["LastName1 (Familias)"];
                        }
                    } else {
                        if ($add == "materno") {
                            $add = "paterno";
                            $name["LastName1 (Familias)"] = $chunk . " " . $name["LastName1 (Familias)"];
                        }
                    }
                }
            }
        }
        $name["LastName2 (Familias)"] = trim($name["LastName2 (Familias)"]);
        $name["LastName1 (Familias)"] = trim($name["LastName1 (Familias)"]);
        return $name;
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

    function StateFullName($Name)
{
    $fullname = State::table('states')->pluck('Name')->toArray();

    $same = null;
    $diference = PHP_INT_MAX;

    foreach ($fullname as $fullname) {
        similar_text($Name, $fullname, $similar);

        if ($similar > 80 && $similar < $diference) {
            $same = $fullname;
            $diference = $similar;
        }
    }

    return $same;
}

public function statesFullName(Request $request)
    {
        $input = strtoupper($request->query('Name'));

    // Buscar en la base de datos directamente
    $matchingState = State::where('Short', $input)->orWhere('Name', 'like', '%' . $input . '%')->first();

    if ($matchingState) {
        return response()->json(['Full Name' => $matchingState->Name]);
    }
}
}
