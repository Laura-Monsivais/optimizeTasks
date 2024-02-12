<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ImportClass;
use App\Models\Family;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Artisan;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    //
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
