<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Profesores extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public function materias(): BelongsToMany
    {
        return $this->belongsToMany(Materias::class, 'pivot_materias_profesores', 'materias', 'profesores');
    }

    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(Cursos::class, 'pivot_cursos_profesores', 'cursos', 'profesores');
    }
}
