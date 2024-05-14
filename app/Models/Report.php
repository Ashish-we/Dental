<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist_id');
    }

    public function procedures()
    {
        return $this->hasMany(Procedure::class, 'procedure_id');
    }
}
