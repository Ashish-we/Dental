<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Dentist extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function doctorType(): BelongsTo
    {
        return $this->belongsTo(DoctorType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function appointments(): BelongsToMany
    // {
    //     return $this->belongsToMany(Appointment::class, 'appointment_dentist');
    // }

    // public function followups(): HasMany
    // {
    //     return $this->hasMany(FollowUp::class);
    // }
}
