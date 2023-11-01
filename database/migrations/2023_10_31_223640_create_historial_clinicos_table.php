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
        Schema::create('historial_clinicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained();
            $table->date("fechaUltimaAtencionDental")->nullable();
            $table->text("RazonUltimaAtencion")->nullable();
            $table->boolean("Hospitalizado");
            $table->text("Medicamentos")->nullable();
            $table->text("Alergias")->nullable();
            $table->text("MolestiasActuales")->nullable();
            $table->text("SeveridadMolestias")->nullable();
            $table->text("AsociacionMolestias")->nullable();
            $table->text("MejoraMolestias")->nullable();
            $table->text("HabitosHigieneBucal")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_clinicos');
    }
};
