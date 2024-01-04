<?php

namespace App\Http\Controllers;

use App\Imports\ImportClass;
use App\Models\State;
use App\Models\Family;
use App\Models\Place;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FamilyController extends Controller
{

    public function index(Request $request)
    {
        $importedData = Excel::toArray(new ImportClass, $request->file('excel_file'));

        $data = $importedData[0]; 

        return view('import', ['data' => $data])->with('success', 'Importación completada correctamente.');
    }

    public function import(Request $request)
    {
        $importedData = Excel::import(new ImportClass, $request->file('excel_file'));

     


        return view('import', ['data' => $importedData])->with('success', 'Importación completada correctamente.');
    }
}
