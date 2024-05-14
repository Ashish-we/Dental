<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeethType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function teeths()
    {
        return $this->hasMany(Teeth::class, 'type_id');
    }
}
