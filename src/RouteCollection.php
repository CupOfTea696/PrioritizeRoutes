<?php
namespace CupOfTea\PrioritizeRoutes;

use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollection as IlluminateRouteCollection;

class RouteCollection extends IlluminateRouteCollection
{
    /**
     * Wether the routes have been sorted.
     *
     * @var bool
     */
    protected $sorted = false;
    
    /**
     * Add a Route instance to the collection.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return \Illuminate\Routing\Route
     */
    public function add(Route $route)
    {
        $this->sorted = false;
        
        return parent::add($route);
    }
    
    /**
     * Get all of the routes in the collection.
     *
     * @param  string|null  $method
     * @return array
     */
    public function get($method = null)
    {
        $this->sort();
        
        return parent::get($method);
    }
    
    /**
     * Get all of the routes in the collection.
     *
     * @return array
     */
    public function getRoutes()
    {
        $this->sort();
        
        return parent::getRoutes();
    }
    
    /**
     * Get all of the routes keyed by their HTTP verb / method.
     *
     * @return array
     */
    public function getRoutesByMethod()
    {
        $this->sort();
        
        return parent::getRoutesByMethod();
    }
    
    /**
     * Compares the priority of two routes for sorting.
     *
     * @param  \Illuminate\Routing\Route  $route1
     * @param  \Illuminate\Routing\Route  $route2
     * @return int
     */
    protected function comparePriority(Route $route1, Route $route2)
    {
        $p1 = $route1->getPriority();
        $p2 = $route2->getPriority();
        
        if ($p1 == $p2) {
            return 0;
        }
        
        return ($p1 < $p2) ? 1 : -1;
    }
    
    /**
     * Sort the routes by their Priority.
     *
     * @return \CupOfTea\PrioritizeRoutes\RouteCollection
     */
    public function sort()
    {
        if ($this->sorted) {
            return;
        }
        
        uasort($this->allRoutes, [$this, 'comparePriority']);
        
        foreach ($this->routes as &$routes) {
            uasort($routes, [$this, 'comparePriority']);
        }
        
        $this->sorted = true;
        
        return $this;
    }
}
