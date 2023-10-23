<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $fillable = ['ID', 'Name'];

    public function states(){
        return $this->hasMany(State::class,'id');
    }
}
