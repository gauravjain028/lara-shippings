<?php

namespace Gauravjain028\LaraShippings\Address\Usps;

use Gauravjain028\LaraShippings\Abstracts\Address;
use Gauravjain028\LaraShippings\Interfaces\Address as InterfacesAddress;

class USPSAddress extends Address implements InterfacesAddress
{
    public function toString()
    {
        return '<Address  ID="1">' .
                '<Address1>'.$this->address1.'</Address1>'.
                '<Address2>'.$this->address2.'</Address2>'.
                '<City>'.$this->city.'</City>'.
                '<State>'.$this->state.'</State>'.
                '<Zip5>'.$this->zipcode.'</Zip5>'.
                '<Zip4></Zip4>'.
                '</Address>';
    }
}