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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->char('nombre', 70);
            $table->char('apellido', 70);
            $table->biginteger('dni');
            $table->biginteger('telefono');
            $table->integer('edad');
            $table->timestamp('nacimiento');
            $table->foreignId('tutor');
            $table->foreignId('cursos');
            $table->timestamps();
        });

        Schema::create('tutor', function (Blueprint $table) {
            $table->id();
            $table->char('nombre', 70);
            $table->char('apellido', 70);
            $table->biginteger('dni');
            $table->biginteger('telefono');
            $table->timestamps();
        });

        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->integer('curso');
            $table->integer('division');
        });

        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->char('materia', 200);
        });

        Schema::create('pivot_materias_cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materias');
            $table->foreignId('cursos');
        });

        Schema::create('profesores', function (Blueprint $table) {
            $table->id();
            $table->char('nombre', 70);
            $table->char('apellido', 70);
            $table->biginteger('dni');
            $table->biginteger('telefono');
        });

        Schema::create('pivot_materias_profesores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materias');
            $table->foreignId('profesores');
        });

        Schema::create('pivot_cursos_profesores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cursos');
            $table->foreignId('profesores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
