<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellido', 'dni', 'telefono', 'nacimiento', 'tutor', 'cursos'];
}
