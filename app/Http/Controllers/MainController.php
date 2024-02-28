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
        $data = TemporaryTable::all();
        session()->put('imported_data', $data);
        return redirect()->route('showTableImport');
    }

    public function showTableImport()
    {
        $data = session()->get('imported_data');
        return view('import-table', compact('data'));
    }

    public function checkUpdates()
    {
        $currentCount = TemporaryTable::count();
    
        $previousCount = session('imported_data_count', 0);
        $changes = $currentCount !== $previousCount;
    
        session(['imported_data_count' => $currentCount]);
    
        return response()->json(['changes' => $changes]);
    }
    
}
