<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Procedure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'address',
    //     'contact'
    // ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function dentist(): HasOne
    {
        return $this->hasOne(Dentist::class);
    }


    // public function medicalRecord()
    // {
    //     return $this->hasOne(MedicalRecord::class, 'patient_id');
    // }
    public function teeths()
    {
        return $this->hasMany(Teeth::class, 'patient_id');
    }

    // public function reports()
    // {
    //     return $this->hasMany(Report::class);
    // }



    public function dentist_followup(): HasOne
    {
        return $this->hasOne(FollowUp::class);
    }

    public function dentist_appointment(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class, 'appointment_dentist');
    }

    // public function dentist_patient(): HasManyThrough
    // {
    //     return $this->hasManyThrough(Patient::class, 'appointment_dentist', 'user_id', 'patient_id');
    // }
}
