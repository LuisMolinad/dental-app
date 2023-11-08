<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class historialClinico extends Model
{
    use HasFactory;
    protected $table = 'historial_clinicos';
    protected $fillable = [
        'fechaUltimaAtencionDental',
        'RazonUltimaAtencion',
        'Medicamentos',
        'Alergias',
        'MolestiasActuales',
        'SeveridadMolestias',
        'AsociacionMolestias',
        'MejoraMolestias',
        'HabitosHigieneBucal'
    ];

    //Relacion con Paciente
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }
}
