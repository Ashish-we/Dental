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
        Schema::create('teeths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained(table: 'patients')->cascadeOnDelete();
            $table->foreignId('type_id')->constrained(table: 'teeth_types')->cascadeOnDelete()->cascadeOnDelete();
            $table->string('tooth_number');
            $table->longText('condition')->nullable();
            $table->longText('notes')->nullable();
            $table->foreignId('procedure_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teeths');
    }
};
