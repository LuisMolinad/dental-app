<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Paciente extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'pacientes';
    protected $fillable = [
        'nombre', 'apellido', 'email', 'telefono', 'fecha_nacimiento', 'correo_electronico', 'nombre_contacto_emergencia', 'contacto_emergencia'
    ];
}
