<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $table = 'nationality';
    protected $fillable = ['ID', 'Name'];
    public function FindNationality($id) {
        $Nacionality = Nationality::find($id);
    
        if ($Nacionality) {
            return $Nacionality;
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }
}
