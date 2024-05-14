<?php

namespace App\Models;


use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category_id',
        'treatment_type',
        'price',


    ];
    public function appointments(): HasOne
    {
        return $this->hasOne(Appointment::class);
    }

    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }
    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class);
    }
}
