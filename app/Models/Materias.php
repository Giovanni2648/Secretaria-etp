<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materias extends Model
{
    use HasFactory;

    public function alumnos(): HasMany
    {
        return $this->hasMany(Alumnos::class);
    }

    public function profesores(): BelongsToMany
    {
        return $this->belongsToMany(Profesores::class, 'pivot_materias_profesores', 'materias', 'profesores');
    }

    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(Cursos::class, 'pivot_materias_cursos', 'materias', 'cursos');
    }
}
