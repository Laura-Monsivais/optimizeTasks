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
}
