<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descripcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descripcion'
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
