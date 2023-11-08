<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Paciente extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'pacientes';
    protected $fillable = [
        'nombre', 'apellido', 'email', 'telefono', 'fecha_nacimiento', 'correo_electronico', 'nombre_contacto_emergencia', 'contacto_emergencia'
    ];


    public function historial_clinico(): HasOne
    {
        return $this->hasOne(historialClinico::class);
    }
}
