<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BaseModel extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes, HasSlug;

    /*
    |--------------------------------------------------------------------------
    | Slug settings
    |--------------------------------------------------------------------------
    */

    /**
     * Get the options for generating the slug.
     *
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(48);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /*
    |--------------------------------------------------------------------------
    | Media Library settings
    |--------------------------------------------------------------------------
    */

    /**
     * Defining media collections for this model
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile()
            ->withResponsiveImages()
            ->useFallbackUrl('/media/placeholder250.png')
            ->useFallbackPath(public_path('/media/placeholder250.png'));

        $this->addMediaCollection('images')
            ->withResponsiveImages();
    }

    /**
     * Generate thumbnail conversion for items in the collection.
     *
     * @param Media|null $media
     * @return void
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_CROP, 250, 250)
            ->nonQueued();
    }

}
