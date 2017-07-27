<?php

namespace Stylers\Ecommerce\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EcommerceServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('ecommerce.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../../config/config.php', 'ecommerce'
        );
    }

    protected function publishDatabase()
    {
        $this->publishes([
            __DIR__ . '/../../database/Migrations/' => database_path('/migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../../database/Seeders/' => database_path('/seeds')
        ], 'seeds');
    }

    protected function bootRoutes()
    {
        $this->app->booted(function () {
            require __DIR__ . '/../routes.php';
        });
    }

    protected function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/../../public/' => public_path('/plugins/ecommerce')
        ], 'public');
    }

    protected function bootViewLocations()
    {
        View::addLocation(__DIR__ . '/../Views/');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->publishDatabase();
        $this->bootRoutes();
        $this->bootViewLocations();
        $this->publishAssets();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            \Stylers\Ecommerce\Console\ProductImportCommand::class
        ]);
    }
}