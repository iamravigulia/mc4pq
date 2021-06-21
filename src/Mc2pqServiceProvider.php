<?php

namespace edgewizz\Mc2pq;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class Mc2pqServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Edgewizz\Mc2pq\Controllers\Mc2pqController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // dd($this);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__ . '/components', 'mc2pq');
        Blade::component('mc2pq::mc2pq.open', 'mc2pq.open');
        Blade::component('mc2pq::mc2pq.index', 'mc2pq.index');
        Blade::component('mc2pq::mc2pq.edit', 'mc2pq.edit');
    }
}
