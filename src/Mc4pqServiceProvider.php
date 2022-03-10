<?php

namespace edgewizz\Mc4pq;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class Mc4pqServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Edgewizz\Mc4pq\Controllers\Mc4pqController');
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
        $this->loadViewsFrom(__DIR__ . '/components', 'mc4pq');
        Blade::component('mc4pq::mc4pq.open', 'mc4pq.open');
        Blade::component('mc4pq::mc4pq.index', 'mc4pq.index');
        Blade::component('mc4pq::mc4pq.edit', 'mc4pq.edit');
    }
}
