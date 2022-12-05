<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends BaseModel
{
    use HasUuids, HasFactory;

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
