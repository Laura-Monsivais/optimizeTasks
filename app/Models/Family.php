<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable=['LastName1','LastName2','Address1','ExtNum','IntNum','Address2','City','County','StateID','CodigoPostal','CountryID','Phone1','Phone2'];
}
