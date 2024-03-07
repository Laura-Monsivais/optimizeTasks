<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLevel extends Model
{
    use HasFactory;

    protected $fillable=['Name','Short','CurrentCap','FutureCap','GroupCap','NivelEducativoID','SEPName','Accounting','Visible','Delta'];

    public function FindClassLevel($id) {
        $classLevel = ClassLevel::find($id);
    
        if ($classLevel) {
            return $classLevel;
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }

}
