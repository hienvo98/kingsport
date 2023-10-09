<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImageStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('image-storage-library', function ($app) {
            return new ImageStorageLibrary();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
