<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

/**
 * @method asset(string $string)
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        /* Register the IDE Helper, only when developing on a local environment */
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        /* Set Eloquent strictness, only in non-production environment */
        Model::shouldBeStrict(! $this->app->isProduction());

        /* Define favicon alias using a macro: https://laravel.com/docs/9.x/vite#blade-aliases */
        Vite::macro('favicon', fn ($asset) => $this->asset("resources/favicon/$asset"));
    }
}
