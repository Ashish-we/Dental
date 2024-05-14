<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'id';
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            $patient->registration_no = static::generateRegistrationNumber();
        });
    }

    // Generate a unique registration number
    protected static function generateRegistrationNumber()
    {
        $prefix = 'PAT'; // You can set any prefix you want
        $timestamp = now()->format('YmdHis'); // Current timestamp
        $randomDigits = mt_rand(1000, 9999); // Generate random 4-digit number
        $uniqueId = uniqid(); // Generate a unique identifier

        // Concatenate all parts to create a unique registration number
        $registrationNumber = $prefix . '-' . $timestamp . '-' . $randomDigits . '-' . $uniqueId;

        return $registrationNumber;
    }

    protected $guarded = [];

    public function medicalRecord(): HasOne
    {
        return $this->hasOne(MedicalRecord::class);
    }

    public function teeths(): HasMany
    {
        return $this->hasMany(Teeth::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class, 'patient_id');
    }
}
