<?php

namespace Gauravjain028\LaraShippings\Providers\Usps;

use Gauravjain028\LaraShippings\Absctracts\Provider;
use Gauravjain028\LaraShippings\Abstracts\Address;
use Gauravjain028\LaraShippings\Address\Usps\USPSAddress;
use Gauravjain028\LaraShippings\Interfaces\Provider as InterfacesProvider;
use UnexpectedValueException;

class UspsProvider extends Provider implements InterfacesProvider
{
    public function getEndpointUrl()
    {
        return 'https://secure.shippingapis.com/ShippingAPI.dll';
    }

    public function getAddress($address = []) 
    {
        return new USPSAddress($address);
    }

    public function findCityState($zipcode)
    {
        $requestXml = '<CityStateLookupRequest USERID="'.$this->clientId.'">' .
                        '<ZipCode ID="0">' .
                            '<Zip5>'.$zipcode.'</Zip5>' .
                        '</ZipCode>' .
                    '</CityStateLookupRequest>';


        // prepare xml doc for query string
        $requestXml = preg_replace('/[\t\n]/', '', $requestXml);

        $response = $this->getHttpClient()->get($this->getEndpointUrl(), [
            'query' => [
                'API' => 'CityStateLookup',
                'XML' => $requestXml
            ]
        ]);

        $responseXml = simplexml_load_string((string) $response->getBody());
        $responseXml = $responseXml->ZipCode;
    
        if ($responseXml->Error) {
            throw new UnexpectedValueException($responseXml->Error->Description);
        }
        
        return (array) $responseXml->children();
    }

    public function findZipcode(Address $address)
    {
        $requestXml = '<ZipCodeLookupRequest USERID="'.$this->clientId.'">' .
                        $address->toString().
                    '</ZipCodeLookupRequest>';

        // prepare xml doc for query string
        $requestXml = preg_replace('/[\t\n]/', '', $requestXml);

        $response = $this->getHttpClient()->get($this->getEndpointUrl(), [
            'query' => [
                'API' => 'ZipCodeLookup',
                'XML' => $requestXml
            ]
        ]);

        $responseXml = simplexml_load_string((string) $response->getBody());
        $responseXml = $responseXml->Address;
    
        if ($responseXml->Error) {
            throw new UnexpectedValueException($responseXml->Error->Description);
        }
        
        return (array) $responseXml->children();
    }
}