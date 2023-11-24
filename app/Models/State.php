<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $fillable = ['ID', 'Name'];

    public function FindFamily($id) {
        $State = Family::find($id);
    
        if ($State) {
            return $State;
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }
}
