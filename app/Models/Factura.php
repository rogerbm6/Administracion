<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withPivot(['cantidad', 'notas_privadas'])->as('factura_producto');
    }

    public function trabajadors()
    {
        return $this->belongsToMany(Trabajador::class)->withPivot(['pago_trabajador', 'limpiezas'])->as('factura_trabajador');
    }

}
