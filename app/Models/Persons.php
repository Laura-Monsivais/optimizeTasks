<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
    use HasFactory;

    protected $fillable=['Name','Last','Last2','Gender','BirthDate','BirthPlaceID','BirthCity','CURP','CellPhone','PrimaryEmail','MaritalStatusID','WorkPlace','WorkJob'];

    public function FindFamily($id) {
        $Persons = Family::find($id);
    
        if ($Persons) {
            return $Persons;
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }
}
