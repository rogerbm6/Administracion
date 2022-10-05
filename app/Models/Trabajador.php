<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'telefono'
    ];

    public function facturas()
    {
        return $this->belongsToMany(Factura::class)->withPivot(['pago_trabajador', 'limpiezas'])->as('factura_trabajador');
    }
}
