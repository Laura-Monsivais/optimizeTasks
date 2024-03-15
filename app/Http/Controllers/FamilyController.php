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
        $addresses = $request->input('columnData');
        $separatedAddresses = [];

        // Verificar si se proporcionó un array de direcciones
        if (!is_array($addresses)) {
            return response()->json([
                'success' => false,
                'message' => 'La dirección no es un array válido.',
            ]);
        }

        // Obtener todos los registros de la tabla temporal
        $records = TemporaryTable::all();

        // Inicializar un contador para rastrear los registros en la tabla temporal
        $recordIndex = 0;

        // Iterar sobre las direcciones proporcionadas
        foreach ($addresses as $addressIndex => $address) {
            // Incrementar el índice solo si la dirección no está vacía
            if (!empty($address)) {
                $recordIndex++;

                // Separar la dirección por espacios
                $addressParts = explode(' ', $address);

                // Inicializar variables para cada parte de la dirección
                $Address1 = '';
                $IntNum = '';
                $ExtNum = '';
                $Address2 = '';

                foreach ($addressParts as $partKey => $part) {
                    // Verificar si la parte actual es numérica
                    if (is_numeric($part) || (preg_match('/^\d+[a-zA-Z]*$/', $part))) {
                        // Si hay otra parte numérica o alfanumérica siguiente, considerarla como número exterior
                        if (isset($addressParts[$partKey + 1]) && (is_numeric($addressParts[$partKey + 1]) || preg_match('/^\d+[a-zA-Z]*$/', $addressParts[$partKey + 1]))) {
                            $ExtNum = $part;
                            // Verificar si la parte siguiente es el número interior
                            if (isset($addressParts[$partKey + 2]) && strtolower($addressParts[$partKey + 2]) === 'int') {
                                $IntNum = $addressParts[$partKey + 1];
                                $partKey += 2; // Saltar la parte del número interior
                            }
                        } else {
                            // Si solo hay una parte numérica o alfanumérica, considerarla como número exterior
                            $ExtNum = $part;
                        }
                        // Las partes anteriores a la parte numérica o alfanumérica son la calle
                        $Address1 = implode(' ', array_slice($addressParts, 0, $partKey));
                        // Las partes posteriores a la parte numérica o alfanumérica son la colonia
                        $Address2 = implode(' ', array_slice($addressParts, $partKey + 1));
                        break;
                    }
                }

                // Verificar si existe un registro correspondiente en la tabla temporal
                if (isset($records[$recordIndex - 1])) {
                    // Obtener el registro correspondiente
                    $record = $records[$recordIndex - 1];
                    // Decodificar el JSON "data" del registro
                    $recordData = json_decode($record->data, true);

                    // Agregar los campos separados al JSON "data" del registro
                    $recordData['Address1 (familias)'] = $Address1;
                    $recordData['ExtNum (familias)'] = $ExtNum;
                    $recordData['IntNum (familias)'] = $IntNum;
                    $recordData['Address2 (familias)'] = $Address2;

                    // Actualizar el registro con el nuevo JSON "data"
                    $record->update(['data' => json_encode($recordData)]);
                }

                // Agregar los resultados al array de direcciones separadas
                $separatedAddresses[] = [
                    'Address1 (familias)' => $Address1,
                    'ExtNum (familias)' => $ExtNum,
                    'IntNum (familias)' => $IntNum,
                    'Address2 (familias)' => $Address2,
                ];
            }
        }

        // Devolver la respuesta JSON con las direcciones separadas
        return response()->json([
            'success' => true,
            'message' => 'Las direcciones se separaron correctamente.',
            'separatedAddresses' => $separatedAddresses,
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

                $recordData['LastName1 (familias)'] = $namesWithSurnames[$key]['LastName1 (familias)'];
                $recordData['LastName2 (familias)'] = $namesWithSurnames[$key]['LastName2 (familias)'];
                $record->update(['data' => json_encode($recordData)]);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Apellidos separados correctamente.',
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
        $name = array("LastName2 (familias)" => "", "LastName1 (familias)" => "");
        $add = ($firstName)
            ? "paterno"
            : "materno";
        $first_time = true;
        if ($firstName) {
            if (!empty($exist)) {
                foreach ($chunks as $chunk) {
                    if ($first_time) {
                        $name["LastName1 (familias)"] = $name["LastName1 (familias)"] . " " . $chunk;
                        $first_time = false;
                    } else {
                        if (in_array($chunk, $exceptions)) {
                            if ($add == "paterno") {
                                $name["LastName1 (familias)"] = $name["LastName1 (familias)"] . " " . $chunk;
                            } else {
                                $name["LastName2 (familias)"] = $name["LastName2 (familias)"] . " " . $chunk;
                            }
                        } else {
                            if ($add == "paterno") {
                                $name["LastName1 (familias)"] = $name["LastName1 (familias)"] . " " . $chunk;
                                $add = "materno";
                            } else {
                                $name["LastName2 (familias)"] = $name["LastName2 (familias)"] . " " . $chunk;
                                $add = "nombres";
                            }
                        }
                    }
                }
            } else {
                foreach ($chunks as $chunk) {
                    if ($first_time) {
                        $name["LastName1 (familias)"] = $name["LastName1 (familias)"] . " " . $chunk;
                        $first_time = false;
                    } else {
                        if (in_array($chunk, $exceptions)) {
                            if ($add == "paterno") {
                                $name["LastName1 (familias)"] = $name["LastName1 (familias)"] . " " . $chunk;
                            } else {
                                $name["LastName2 (familias)"] = $name["LastName2 (familias)"] . " " . $chunk;
                            }
                        } else {
                            if ($add == "paterno") {
                                $name["LastName2 (familias)"] = $name["LastName2 (familias)"] . " " . $chunk;
                                $add = "materno";
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($chunks as $chunk) {
                if ($first_time) {
                    $name["LastName2 (familias)"] = $chunk . " " . $name["LastName2 (familias)"];
                    $first_time = false;
                } else {
                    if (in_array($chunk, $exceptions)) {
                        if ($add == "materno") {
                            $name["LastName2 (familias)"] = $chunk . " " . $name["LastName2 (familias)"];
                        } elseif ($add == "paterno") {
                            $name["LastName1 (familias)"] = $chunk . " " . $name["LastName1 (familias)"];
                        }
                    } else {
                        if ($add == "materno") {
                            $add = "paterno";
                            $name["LastName1 (familias)"] = $chunk . " " . $name["LastName1 (familias)"];
                        }
                    }
                }
            }
        }
        $name["LastName2 (familias)"] = trim($name["LastName2 (familias)"]);
        $name["LastName1 (familias)"] = trim($name["LastName1 (familias)"]);
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
        $matchingState = State::where('Short', $input)->orWhere('Name', 'like', '%' . $input . '%')->firstOrFail();

        if ($matchingState) {
            return response()->json(['Full Name State ' => $matchingState->Name]);
        } else {
            return response()->json(['error' => 'State not found'], 404);
        }
    }

    public function countryFullName(Request $request)
    {
        $input = strtoupper($request->query('Name'));

        $matchingCountry = Country::where('Short', $input)->orWhere('Name', 'like', '%' . $input . '%')->firstOrFail();

        if ($matchingCountry) {
            return response()->json(['Full Name Country' => $matchingCountry->Name]);
        } else {
            return response()->json(['error' => 'Country not found'], 404);
        }
    }
}
