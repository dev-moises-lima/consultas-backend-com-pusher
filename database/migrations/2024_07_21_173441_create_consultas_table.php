<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Paciente;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Paciente::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->json('sintomas');
            $table->decimal('porcentagem_dos_sintomas_sentidos');
            $table->string('condicao');
            $table->integer('pressao_arterial_diastolica');
            $table->integer('pressao_arterial_sistolica');
            $table->integer('frequencia_cardiaca');
            $table->integer('respiracao');
            $table->decimal('temperatura', places: 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
