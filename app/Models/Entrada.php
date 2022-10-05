<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrada', 'salida', 'personas'
    ];

    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }
}
