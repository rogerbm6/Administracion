<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function descripcion()
    {
        return $this->belongsTo(Descripcion::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
