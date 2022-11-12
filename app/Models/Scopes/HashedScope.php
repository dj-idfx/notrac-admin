<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class HashedScope implements Scope
{
    /**
     * Apply the global hashed scope to the query builder, primarily used to exclude hashed users.
     * Hashing users is usefully when somebody wants all their data to be removed (GDPR),
     * but we still want to keep user records and relations anonymously in the database.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereNull('hashed_at');
    }
}
