<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Tutores extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'tutor';

    public function alumnos(): HasMany
    {
        return $this->hasMany(Alumnos::class);
    }
}
