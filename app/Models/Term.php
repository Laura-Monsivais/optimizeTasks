<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $fillable=['ID','NextID','TermProfileID','BillingPeriodID','Name','OficialName','StartDate','EndDate','Status','StudentsStatus','K12_SEPBimGPsEq'];

    public function FindTerm($id) {
        $Term = Term::find($id);
    
        if ($Term) {
            return $Term;
        } else {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }
    }
}
