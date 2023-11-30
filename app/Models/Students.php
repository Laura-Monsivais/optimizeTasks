<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $fillable=['Name','Last','Last2','Gender','CURP','MaritalStatusID','BirthDate','BirthCity','BirthPlaceID','NationalityID','ReligionID','CellPhone','PrimaryEMail','ProgramID','TermID','ClassLevelID','GroupID'];
   
    public function Alumnos(){
        return $this->hasMany(Students::class,'id');
    }

    public function FindStudent($id) {
        $Alumnos = Students::find($id);
    
        if ($Alumnos) {
            return $Alumnos;
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }

}

