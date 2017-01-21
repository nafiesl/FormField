<?php

namespace Luthfi\FormField;

use Illuminate\Support\ServiceProvider;

/**
* FormField Service Provider Class
*/
class FormFieldServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('formField', function($app) {
            return new FormField;
        });

    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'form-field');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/form-field'),
        ]);
    }
}