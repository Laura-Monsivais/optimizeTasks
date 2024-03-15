<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $table = 'marital_status';
    protected $fillable = ['ID', 'Name'];

    public function FindMaritalStatus($id)
    {
        $Marital = MaritalStatus::find($id);

        if ($Marital) {
            return $Marital;
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }
}
