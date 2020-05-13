<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoFamiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_familiares', function (Blueprint $table) {
            $table->id();
            $table->string('nombres_conyugue',100)->nullable();
            $table->string('apellidos_conyugue',100)->nullable();
            $table->string('ocupacion_conyugue',255)->nullable();
            $table->string('direccion_conyugue',200)->nullable();
            $table->string('telefono_conyugue',100)->nullable();
            $table->string('nombres_padre',100)->nullable();
            $table->string('apellidos_padre',100)->nullable();
            $table->string('nombres_madre',100)->nullable();
            $table->string('apellidos_madre',100)->nullable();
            $table->bigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('empleado_familiars');
    }
}
