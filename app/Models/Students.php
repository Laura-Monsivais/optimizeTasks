<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $fillable=['FamilyID','Name','Last','Last2','Gender','CURP','MaritalStatusID','BirthDate','BirthCity','BirthPlaceID','NationalityID','ReligionID','CellPhone','PrimaryEMail','ProgramID','TermID','ClassLevelID','GroupID'];
   
    public function Nationality(){
        return $this->belongsTo(Nationality::class,'NationalityID');
    }



}

