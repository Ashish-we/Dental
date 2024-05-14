<?php

namespace App\Models;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Procedure extends Model
{
    use HasFactory;

    // protected $fillable = ['name', 'patient_id', 'appointment_id', 'teeth_id', 'description', 'cost'];
    protected $guarded = ['id'];



    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }


    public function teeth(): HasMany
    {

        return $this->hasMany(Teeth::class);
    }

    public function report()
    {

        return $this->belongsTo(Report::class, 'report_id');
    }

    public function serivice(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
