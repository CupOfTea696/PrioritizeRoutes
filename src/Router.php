<?php

namespace CupOfTea\PrioritizeRoutes;

use CupOfTea\Package\Package;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Routing\Route as IlluminateRoute;
use Illuminate\Routing\Router as IlluminateRouter;

class Router extends IlluminateRouter
{
    use Package;
    
    /**
     * Package Vendor.
     *
     * @const string
     */
    const VENDOR = 'CupOfTea';
    
    /**
     * Package Name.
     *
     * @const string
     */
    const PACKAGE = 'PrioritizeRoutes';
    
    /**
     * Package Version.
     *
     * @const string
     */
    const VERSION = '0.0.0';
    
    /**
     * Original Router.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $illuminateRouter;
    
    /**
     * Create a new Router instance.
     *
     * @param  Dispatcher  $events
     * @param  Container  $container
     * @return void
     */
    public function __construct(Dispatcher $events, Container $container = null, IlluminateRouter $illuminateRouter = null)
    {
        parent::__construct($events, $container);
        
        $this->routes = new RouteCollection;
        $this->illuminateRouter = $illuminateRouter;
    }
    
    /**
     * Create a new Route object.
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  mixed   $action
     * @return \CupOfTea\PrioritizeRoutes\Route
     */
    protected function newRoute($methods, $uri, $action)
    {
        return with(new Route($methods, $uri, $action))->setContainer($this->container);
    }
    
    /**
     * Gather the middleware for the given route.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return array
     */
    public function gatherRouteMiddleware(IlluminateRoute $route)
    {
        $middleware = array_merge(
            $this->illuminateRouter->gatherRouteMiddleware($route),
            parent::gatherRouteMiddleware($route)
        );
        
        return $this->sortMiddleware($middleware);
    }
}
