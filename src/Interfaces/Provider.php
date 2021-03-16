<?php

namespace Gauravjain028\LaraShippings\Interfaces;

use Gauravjain028\LaraShippings\Abstracts\Address;

interface Provider
{
    public function findCityState($zipcode);

    public function findZipcode(Address $address);
}
