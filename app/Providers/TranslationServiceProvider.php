<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register the translator service
        $this->app->singleton('translator', function ($app) {
            return $app->loadComponent('translation', 'Illuminate\Translation\TranslationServiceProvider', 'translator');
        });
    }
}
