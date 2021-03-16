<?php

namespace Gauravjain028\LaraShippings\Facades;

use Illuminate\Support\Facades\Facade;
use Gauravjain028\LaraShippings\Contracts\Factory;

class LaraShippings extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
