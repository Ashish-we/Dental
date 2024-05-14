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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            // $table->string('title');
            $table->longText('chief_complaint')->nullable();
            $table->dateTime('date');
            $table->foreignId('service_id')->constrained(table: 'services')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('condition')->nullable();
            $table->string('status');
            $table->foreignId('patient_id')->constrained(table: 'patients')->cascadeOnDelete();
            // $table->foreignId('dentist_id')->references('user_id')->on('dentists')->constrained()->cascadeOnDelete()->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('appointment_dentist', function (Blueprint $table) {
        //     // Drop the foreign key constraint before dropping the table
        //     $table->dropForeign(['appointment_id']);
        // });
        Schema::dropIfExists('appointments');
    }
};
