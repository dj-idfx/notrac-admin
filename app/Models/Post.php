<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia
{
    use HasUuids, HasFactory, SoftDeletes, HasSlug, InteractsWithMedia;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        //
    }

    /*
     |--------------------------------------------------------------------------
     | Attribute settings
     |--------------------------------------------------------------------------
     */

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'quill' => '',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'quill',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published'     => 'boolean',
        'published_at'  => 'datetime',
    ];

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
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->nonQueued();
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    ! Add global scopes inside the "booted" method of this model.
    */

    /**
     * Local scope for only including published posts.
     *
     * @param  Builder  $query
     * @return void
     */
    public function scopeIsPublished(Builder $query): void
    {
        $query->whereNotNull('published_at');
    }

    /**
     * Local scope for including only the  un-published posts.
     *
     * @param  Builder  $query
     * @return void
     */
    public function scopeIsUnpublished(Builder $query): void
    {
        $query->whereNull('published_at');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'published',
    ];

    /**
     * Get the post published state
     *
     * @return Attribute
     */
    protected function published(): Attribute
    {
        return Attribute::get(fn () => (bool)$this->published_at);
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'first_name' => 'Anonymous',
            'last_name'  => 'User',
        ]);
    }

}
