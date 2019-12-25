<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DiDom\Document;

class DiDomServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('DiDom\Document', function ($app) {
          return new Document();
        });
    }
}
