<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcedureTeeth extends Model
{
    use HasFactory;
    public function teeths(){
        return $this->belongsToMany(Teeth::class);
        
    }
}
