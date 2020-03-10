<?php

namespace App;

use App\Services\Media\ImagesAttribute;
use App\Services\Media\LogoAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Console
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string|null $description
 * @property string|null $information
 * @property string|null $released_at
 * @property string|null $unreleased_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-write mixed $images
 * @property-write mixed $logo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereReleasedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereUnreleasedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Game[] $games
 * @property-read int|null $games_count
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console whereParentId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Console[] $children
 * @property-read int|null $children_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Console parent()
 */
class Console extends Model implements HasMedia
{
    use HasMediaTrait;
    use LogoAttribute;
    use ImagesAttribute;

    protected $dates = [
        'created_at',
        'updated_at',
        'released_at',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function children()
    {
        return $this->hasMany(Console::class, 'parent_id', 'id')->orderBy('released_at');
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

    public function scopeParent(Builder $query)
    {
        $query->where('parent_id', 0);
    }
}
