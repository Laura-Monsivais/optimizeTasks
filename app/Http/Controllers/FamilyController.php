<?php

namespace App\Http\Controllers;

use App\Imports\ImportClass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
    public function validateCURP(Request $request){}
}
