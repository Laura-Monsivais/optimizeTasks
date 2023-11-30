<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Family;
use App\Models\Place;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index()
    {
        $family = Family::all();
        return $family;
        //return response()->json( $family );//
    }

    public function getStateID($id)
    {
        $stateId = State::find($id);
        return $stateId;
    }

    public function registerFamily(Request $request)
    {

        $request->validate([
            'Last2' => 'required',
            'Phone1' => 'max:10'
        ]);

        Family::create(
            [
                'Last2' => $request->input('Last2'),
                'Phone1' => $request->input('Phone1')
            ]
        );
        return response()->json(['Familia creada exitosamente'],200);
    }
}
