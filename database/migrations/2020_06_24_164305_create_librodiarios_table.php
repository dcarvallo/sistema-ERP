<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrodiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('librodiarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nro_asiento');
            $table->string('tipo_asiento');
            $table->date('fecha');
            $table->string('cuenta');
            $table->string('descripcion');
            $table->string('documento');
            $table->float('debe');
            $table->float('haber');
            $table->string('notas')->nullable();
            $table->string('archivo')->nullable();
            $table->unsignedBigInteger('creador_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('creador_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('librodiarios');
    }
}
