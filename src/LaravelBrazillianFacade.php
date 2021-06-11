<?php

namespace Joaovdiasb\LaravelBrazillian;

use Illuminate\Support\Facades\Facade;

class LaravelBrazillianFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-brazillian';
    }
}
