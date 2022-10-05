<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function facturas()
    {
        return $this->belongsToMany(Factura::class)->withPivot(['cantidad', 'notas_privadas'])->as('factura_producto');
    }

}
