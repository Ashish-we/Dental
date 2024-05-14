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
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            // $table->string('tooth_number')->nullable();
            $table->longText('condition')->nullable();
            $table->foreignId('appointment_id')->references('id')->on('appointments')->cascadeOnDelete();
            $table->foreignId('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreignId('service_id')->references('id')->on('services')->cascadeOnDelete();
            $table->double('cost');
            $table->longText('documents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('reports', function (Blueprint $table) {
        //     // Drop the foreign key constraint before dropping the table
        //     $table->dropForeign(['procedure_id']);
        // });
        // Schema::table('teeths', function (Blueprint $table) {
        //     // Drop the foreign key constraint before dropping the table
        //     $table->dropForeign(['procedure_id']);
        // });
        Schema::dropIfExists('procedures');
    }
};
