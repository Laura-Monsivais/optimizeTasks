<?php

namespace App\Http\Controllers;

use App\Imports\ImportClass;
use App\Models\Family;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Artisan;

class FamilyController extends Controller
{
    public function test_console_command()
{
    $this->artisan('inspire')->assertExitCode(0);
    $this->artisan('inspire')->assertSuccessful();
    $this->artisan('inspire')->assertFailed();
}

    public function showImport()
    {
        return view('import');
    }

    public function uploadImport(Request $request)
    {
        Excel::import(new ImportClass, $request->file('excel_file')->store('import_files'));
        return back();
    }

}
function address($address)
{
    $calle = '';
    $numeroInterior = '';
    $numeroExterior = '';
    $colonia = '';

    $addressParts = explode(',', $address);

    if (count($addressParts) >= 2) {
        $numberStreet = trim($addressParts[0]);

        // Remove leading numbers and spaces from the beginning of the street name
        $numberStreet = preg_replace('/^\d+\s*/', '', $numberStreet);

        $partsStreets = explode(' ', $numberStreet);

        $calle = array_shift($partsStreets);

        foreach ($partsStreets as $key => $parte) {
            if (is_numeric($parte)) {
                // Check for common terms like "Ext" or "Int" indicating exterior or interior
                $nextPart = isset($partsStreets[$key + 1]) ? $partsStreets[$key + 1] : '';
                if (is_numeric($nextPart)) {
                    $numeroInterior = $parte;
                    $numeroExterior = $nextPart;
                    break;
                } else {
                    $numeroExterior = $parte;
                }
            }
        }

        $colonia = trim($addressParts[1]);
    } else {
        $calle = $address;
    }

    return [
        'calle' => $calle,
        'numero_interior' => $numeroInterior,
        'numero_exterior' => $numeroExterior,
        'colonia' => $colonia,
    ];

}

$address = "Cerro del Peñon 5453, Valle de las Cumbres segundo sector";
$resultado = address($address);
print_r($resultado);

    /* Separar apellidos */
function separateSurnames(Request $request)
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
function validateCURP(Request $request){};

