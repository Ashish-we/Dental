<?php

namespace App\Models;


use App\Enums\AppointmentStatusEnum;
use App\Models\Procedure;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'date',
    //     'patient_id',
    //     'dentist_id',
    //     'visit',
    //     'status',
    //     'service_id',
    //     'notes',
    // ];
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function dentists(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'appointment_dentist');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function procedures()
    {
        return $this->hasMany(Procedure::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function followUp(): HasOne
    {
        return $this->hasOne(FollowUp::class);
    }
}
