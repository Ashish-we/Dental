<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    public function appointment(){
        return $this->hasOne(Appointment::class,'appointment_id');
    }
}
