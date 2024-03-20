<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $fillable = ['FamilyID', 'Name', 'Last', 'Last2', 'Gender', 'CURP', 'MaritalStatusID', 'BirthDate', 'BirthCity', 'BirthPlaceID', 'NationalityID', 'ReligionID', 'CellPhone', 'PrimaryEMail', 'ProgramID', 'TermID', 'ClassLevelID', 'GroupID'];

    public function Family(){
        return $this->hasOne(Family::class,'FamilyID');
    }
    public function MaritalStatus(){
        return $this->hasOne(MaritalStatus::class,'MaritalStatusID');
    }
    public function Nationality()
    {
        return $this->hasOne(Nationality::class, 'NationalityID');
    }
    public function Program(){
        return $this->hasOne(Program::class,'ProgramID');
    }
    public function Term(){
        return $this->hasOne(Term::class,'TermID');
    }
    public function ClassLevel()
    {
        return $this->hasOne(ClassLevel::class, 'ClassLevelID');
    }
    public function Group(){
        return $this->hasOne(Group::class,'GroupID');
    }
    public function Religion()
    {
        return $this->hasOne(Religion::class, 'ReligionID');
    }
    
}
