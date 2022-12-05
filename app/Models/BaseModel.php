<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BaseModel extends Model implements HasMedia
{
    use InteractsWithMedia;

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
