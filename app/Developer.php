<?php

namespace App;

use App\Services\Media\ImagesAttribute;
use App\Services\Media\LogoAttribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Developer
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $founded_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Developer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Developer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Developer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Developer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Developer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Developer whereFoundedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Developer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Developer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Developer whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Game[] $games
 * @property-read int|null $games_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-write mixed $logo
 */
class Developer extends Model implements HasMedia
{
    use HasMediaTrait;
    use LogoAttribute;

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(140)
            ->sharpen(3)
            ->performOnCollections('logo');
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
