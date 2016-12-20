<?php

namespace CupOfTea\PrioritizeRoutes;

use Illuminate\Support\ServiceProvider;

class PrioritizeRoutesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/config/routing.php' => config_path('routing.php'),
        ], 'config');
    }
    
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/config/routing.php', 'routing'
        );
        
        $this->app['kernel.router'] = $this->app['router'];
        $this->app['router'] = $this->app->share(function($app) {
            $this->app['kernel.router']->setRoutes(($router = new Router($app['events'], $app, $app['kernel.router']))->getRoutes());
            
            return $router;
        });
    }
}
