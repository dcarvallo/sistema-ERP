<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('empleado_id', 100);
            $table->string('nombres', 100);
            $table->string('ap_paterno', 100);
            $table->string('ap_materno', 100);
            $table->string('nacionalidad', 100)->nullable();
            $table->string('ci', 20);
            $table->string('lugar_exp', 20)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->date('fecha_nac');
            $table->string('lugar_nac', 255)->nullable();
            $table->string('sexo', 10);
            $table->string('estado_civil', 50)->nullable();
            $table->string('telefono', 200)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('religion', 100)->nullable();
            $table->float('altura', 5, 2)->nullable();
            $table->float('peso', 5, 2)->nullable();
            $table->string('tipo_sangre', 10)->nullable();
            $table->string('fotografia', 255)->nullable();
            $table->date('fecha_contrato');
            $table->string('tipo_contrato', 100)->nullable();
            $table->string('estado', 10)->default('Alta');
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->softDeletes();
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
        Schema::dropIfExists('empleados');
    }
}
