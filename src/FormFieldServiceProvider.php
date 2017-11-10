<?php

namespace Luthfi\FormField;

use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Support\ServiceProvider;

/**
 * FormField Service Provider Class.
 */
class FormFieldServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->alias(FormField::class, 'formField');

        $this->app->singleton('form', function ($app) {
            $form = new FormBuilder(
                new HtmlBuilder($app['url'], $app['view']),
                $app['url'], $app['view'],
                $app['session.store']->token()
            );

            return $form->setSessionStore($app['session.store']);
        });

        $this->app->singleton('html', function ($app) {
            return new HtmlBuilder($app['url'], $app['view']);
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'form-field');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/form-field'),
        ]);
    }
}
