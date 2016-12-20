<?php

namespace CupOfTea\PrioritizeRoutes;

use InvalidArgumentException;
use Illuminate\Routing\Route as IlluminateRoute;

class Route extends IlluminateRoute
{
    /**
     * The Route's priority.
     *
     * @var int
     */
    protected $priority;
    
    /**
     * Set the Route's priority.
     * @param  int  $priority
     *
     * @return CupOfTea\PrioritizeRoutes\Route
     * @throws \InvalidArgumentException
     */
    public function priority($priority)
    {
        if (! is_numeric($priority)) {
            throw new InvalidArgumentException('The $priority parameter must be numeric.');
        }
        
        $this->priority = $priority;
        
        return $this;
    }
    
    /**
     * Get the Route's priority.
     *
     * @return int
     */
    public function getPriority()
    {
        if (is_null($this->priority)) {
            return config('routing.priority', 0);
        }
        
        return $this->priority;
    }
}
