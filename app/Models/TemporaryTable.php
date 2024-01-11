<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryTable extends Model
{
    use HasFactory;

    protected $table = 'temporary';

    protected $fillable = [
        'data',
    ];

    public function getDataAttribute()
    {
        return json_decode($this->attributes['data'], true);
    }
}
