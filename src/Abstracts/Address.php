<?php

namespace Gauravjain028\LaraShippings\Abstracts;

use Gauravjain028\LaraShippings\Contracts\Address as ContractsAddress;

abstract class Address implements ContractsAddress
{
    protected $address1;

    protected $address2;

    protected $city;

    protected $state;

    protected $zipcode;

    protected $country;

    public function __construct($address = [])
    {
        $this->address1 = $address['address1'] ?? '';
        $this->address2 = $address['address2'] ?? '';
        $this->city = $address['city'] ?? '';
        $this->state = $address['state'] ?? '';
        $this->zipcode = $address['zipcode'] ?? '';
        $this->country = $address['country'] ?? '';
    }

    abstract public function toString();
}