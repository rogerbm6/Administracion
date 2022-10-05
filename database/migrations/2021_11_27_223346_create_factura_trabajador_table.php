<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaTrabajadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_trabajador', function (Blueprint $table) {
            $table->foreignId('factura_id')->constrained();
            $table->foreignId('trabajador_id')->constrained();
            $table->double('pago_trabajador', 8, 2);
            $table->unsignedInteger('limpiezas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_trabajador');
    }
}
