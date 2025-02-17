<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('docente_id')->unsigned()->nullable();
            $table->foreign('docente_id')->references('id')->on('users');
            $table->string('nombre');
            $table->string('url_github');
            $table->string('metadatos');
            $table->string('familia');
            $table->string('descripcion')->nullable();
            $table->string('ciclo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
