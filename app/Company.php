<?php

namespace App;

use App\Services\Media\ImagesAttribute;
use App\Services\Media\LogoAttribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Company
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $media
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $description
 * @property-write mixed $images
 * @property-write mixed $logo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereDescription($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Console[] $consoles
 * @property string|null $information
 * @property-read int|null $consoles_count
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereInformation($value)
 */
class Company extends Model implements HasMedia
{
    use HasMediaTrait;
    use LogoAttribute;
    use ImagesAttribute;

    public function consoles()
    {
        return $this->hasMany(Console::class);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(140)
            ->sharpen(3)
            ->performOnCollections('logo', 'images');
    }
}
