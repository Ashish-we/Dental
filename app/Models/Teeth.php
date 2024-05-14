<?php

namespace App\Models;


use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Teeth extends BaseModel implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    // protected $fillable = [

    //     'patient_id',
    //     'condition',
    //     'type_id',
    //     'tooth_number',
    //     'notes',

    // ];
    protected $guarded = [];

    protected $appends = ['image_url'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function type()
    {
        return $this->belongsTo(TeethType::class, 'type_id');
    }
    public function procedures(): BelongsTo
    {

        return $this->belongsTo(Procedure::class, 'procedure_id');
    }

    function getImageUrlAttribute()
    {
        return $this->getImage('teeths');
    }
}
