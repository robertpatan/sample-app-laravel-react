<?php declare(strict_types=1);


namespace App\Http\Services;


abstract class AbstractService
{
    /**
     * Creates a resource
     *
     * @param  $parameters
     */
    abstract public function create($parameters);
    
    /**
     * Updates a resource
     *
     * @param  $parameters
     */
    abstract public function update($parameters);
    
    /**
     * Returns a resource
     *
     * @param $parameters
     */
    abstract public function view($parameters);
    
    
}