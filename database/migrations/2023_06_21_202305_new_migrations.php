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
        Schema::table('alumnos', function (Blueprint $table) {
            $table->dropColumn('edad')->change();
        });

        Schema::create('pivot_titulos_profesores', function (Blueprint $table) {
            $table->id();
            $table->char('titulo', 70);
            $table->foreignId('profesores');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
