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
            $table->bigInteger('empleado_id');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('ci', 20)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->date('fecha_nac');
            $table->string('lugar_nac', 255)->nullable();
            $table->tinyInteger('sexo')->nullable();
            $table->string('estado_civil', 50)->nullable();
            $table->string('telefono', 200)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('religion', 100)->nullable();
            $table->float('altura', 5, 2)->nullable();
            $table->float('peso', 5, 2)->nullable();
            $table->string('tipo_sangre', 10)->nullable();
            $table->string('fotografia', 255)->nullable();
            $table->date('fecha_contrato')->nullable();
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('cargo_id');
            $table->string('telefono_int', 50)->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('cargo_id')->references('id')->on('cargos');
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
