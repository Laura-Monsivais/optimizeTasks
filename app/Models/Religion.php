<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;
    protected $table = 'religions';
    protected $fillable = ['ID', 'Name'];

    public static function FindReligion($id)
    {
        $religion = Religion::find($id);

        if ($religion) {
            return $religion;
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }
}
