<?php

namespace App\Http\Controllers;

use App\Imports\ImportClass;
use App\Models\TemporaryTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class FamilyController extends Controller
{

    public function showImport()
    {
        return view('import');
    }

    public function uploadImport(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'excel_file' => 'required|mimes:xlsx|max:10240', // Máximo 10 MB para el ejemplo
        ]);

        try {
            $file = $request->file('excel_file');
            $path = $file->storeAs('import_files', 'imported_file.xlsx');
            Excel::import(new ImportClass, storage_path("app/{$path}"));
            $importedData = (new ImportClass)->getData();
            TemporaryTable::create([
                'data' => json_encode($importedData),
            ]);
            Storage::delete($path);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error durante la importación: ' . $e->getMessage()], 500);
        }


        $temporaryData = TemporaryTable::all();

        return view('import', ['success' => 'Importación exitosa', 'data' => $importedData, 'temporaryData' => $temporaryData]);
    }
}
