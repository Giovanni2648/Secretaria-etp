<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Cursos extends Model
{
    use HasFactory;

    public function alumnos(): HasMany
    {
        return $this->hasMany(Alumnos::class);
    }

    public function materias(): BelongsToMany
    {
        return $this->belongsToMany(Materias::class, 'pivot_materias_cursos', 'materias', 'cursos');
    }

    public function profesores(): BelongsToMany
    {
        return $this->belongsToMany(Profesores::class, 'pivot_cursos_profesores', 'cursos', 'profesores');
    }
}
