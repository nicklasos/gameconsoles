<?php

namespace App;

use App\Services\Media\ImagesAttribute;
use App\Services\Media\LogoAttribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Game extends Model implements HasMedia
{
    use HasMediaTrait;
    use LogoAttribute;
    use ImagesAttribute;

    protected $casts = [
        'information' => 'array',
    ];

    public function consoles()
    {
        return $this->belongsToMany(Console::class);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(140)
            ->sharpen(3)
            ->performOnCollections('logo', 'images');
    }
}
