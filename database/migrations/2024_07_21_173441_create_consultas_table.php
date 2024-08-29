<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Patient;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Patient::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->json('symptoms');
            $table->string('condition');
            $table->decimal('percentageOfSymptomsFelt');
            $table->integer('diastolicBloodPressure');
            $table->integer('systolicBloodPressure');
            $table->integer('heartRate');
            $table->integer('respiratoryRate');
            $table->decimal('temperature', places: 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
