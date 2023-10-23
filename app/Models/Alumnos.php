<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;
    protected $fillable=['Name','Last','Last2','Gender','CURP','MaritalStatusID','BirthDate','BirthCity','BirthPlaceID','NationalityID','ReligionID','CellPhone','PrimaryEMail','ProgramID','TermID','ClassLevelID','GroupID'];
    
}
