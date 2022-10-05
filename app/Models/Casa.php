<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'direccion', 'numero'
    ];


    public function entradas()
    {
        return $this->hasMany(Entrada::class);
    }
}
