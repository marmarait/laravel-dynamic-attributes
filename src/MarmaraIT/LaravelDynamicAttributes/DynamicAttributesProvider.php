<?php

namespace MarmaraIT\LaravelDynamicAttributes;

use Illuminate\Support\ServiceProvider;

class DynamicAttributesProvider extends ServiceProvider{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}