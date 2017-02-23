<?php

namespace WArk\Minio\Providers;

use Illuminate\Support\ServiceProvider;
use WArk\Minio\MinioStorage;

class MinioStorageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('miniostorage.php')
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('miniostorage', function(){
            return new MinioStorage;
        });
    }
}
