<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index(){
        $family = Family::all();
        return view('welcome',compact('family'));
        //return response()->json( $family );//
    }

}

