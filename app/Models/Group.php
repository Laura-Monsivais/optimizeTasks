<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['ProgramShiftID', 'TermID', 'ProgramID', 'ClassLevelID', 'Name', 'Owner_CID'];

    public function Program(){
        return $this->hasOne(Program::class,'ProgramID');
    }

    public function ClassLevel(){
        return $this->hasOne(ClassLevel::class,'ClassLevelID');
    }

    public function Term(){
        return $this->hasOne(Term::class,'TermID');
    }


    public function FindGroup($id)
    {
        $group = Group::find($id);

        if ($group) {
            return $group;
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }
}
