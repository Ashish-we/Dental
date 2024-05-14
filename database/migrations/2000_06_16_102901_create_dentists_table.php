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
        Schema::create('dentists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained(table: 'doctor_types')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained(table: 'users')->cascadeOnDelete();
            $table->text('qualification');
            $table->text('speciality');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('dentists');
    }
};
