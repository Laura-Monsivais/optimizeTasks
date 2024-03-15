<?php

namespace App\Http\Controllers;

use App\Imports\ImportClass;
use App\Models\TemporaryTable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
    public function showImport()
    {
        return view('import');
    }

    public function uploadImport(Request $request)
    {
        $import = new ImportClass;
        Excel::import($import, $request->file('excel_file')->store('import_files'));
        return redirect()->route('showTableImport');
    }

    public function showTableImport()
    {
        $data = TemporaryTable::all();

        if ($data->isEmpty()) {
            // Redirigir a la página 404 si no hay datos
            return response()->view('errors-404', [], 404);
        }
    

        return view('import-table', compact('data'));
    }

    public function checkUpdates()
    {
        $previousData = session('imported_data');
        $currentData = TemporaryTable::pluck('data')->toArray();
        $changes = $previousData !== $currentData;

        session(['imported_data' => $currentData]);

        return response()->json(['changes' => $changes]);
    }
}
