<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use App\Models\Persons;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    public function index()
    {
        $persons = Persons::all();
        return $persons;
        //return response()->json( $family );//
    }

    public function registerPersons(Request $request)
    {

        $request->validate([
            'Name' => 'required',
            'Last' => 'required',
            'CURP' =>'CURP',
            'Phone1' => 'max:10'
        ]);

        Persons::create(
            [
                'Name' => $request->input('Name'),
                'Last' => $request->input('Last'),
                'CURP' => $request->input('CURP'),
                'Phone1' => $request->input('Phone1')
            ]
        );
        return response()->json(['La persona se agrego exitosamente'],200);
    }
}
