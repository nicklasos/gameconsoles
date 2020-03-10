<?php

namespace App;

use App\Services\Media\ImagesAttribute;
use App\Services\Media\LogoAttribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Game
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property array|null $information
 * @property string|null $released_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Console[] $consoles
 * @property-read int|null $consoles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-write mixed $images
 * @property-write mixed $logo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereReleasedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Developer $developer
 * @property int $developer_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereDeveloperId($value)
 */
class Game extends Model implements HasMedia
{
    use HasMediaTrait;
    use LogoAttribute;
    use ImagesAttribute;

    protected $dates = [
        'created_at',
        'updated_at',
        'released_at',
    ];

    protected $casts = [
        'information' => 'array',
    ];

    public function consoles()
    {
        return $this->belongsToMany(Console::class);
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('logo')
            ->useDisk('media');

        $this
            ->addMediaCollection('images')
            ->useDisk('media');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(140)
            ->sharpen(3)
            ->performOnCollections('logo', 'images');
    }
}
