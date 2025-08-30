<?php

namespace App\Models;

// ✅ Paquete nuevo (mongodb/laravel-mongodb)
use MongoDB\Laravel\Eloquent\Model;

class Paciente extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'pacientes';

    protected $fillable = [
        'nombre',
        'edad',
        'email',
        'telefono',
        'fecha_nacimiento',
    ];
}
