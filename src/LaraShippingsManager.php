<?php

namespace Gauravjain028\LaraShippings;

use Gauravjain028\LaraShippings\Contracts\Factory;
use Gauravjain028\LaraShippings\Providers\USPS\USPSProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Manager;
use InvalidArgumentException;

class LaraShippingsManager extends Manager implements Factory
{
    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     * @return mixed
     */
    public function with($driver)
    {
        return $this->driver($driver);
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Gauravjain028\LaraShippings\Abstracts\Provider
     */
    protected function createUSPSDriver()
    {
        $config = $this->config->get('lara-shippings.usps');

        return $this->buildProvider(
            USPSProvider::class, $config
        );
    }

    /**
     * Build an Shipping provider instance.
     *
     * @param  string  $provider
     * @param  array  $config
     * @return \Gauravjain028\LaraShippings\Abstracts\Provider
     */
    public function buildProvider($provider, $config)
    {
        return new $provider(
            $this->container->make('request'), $config['client_id'],
            $config['client_secret'], Arr::get($config, 'guzzle', [])
        );
    }

    /**
     * Get the default driver name.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No Shipping driver was specified.');
    }
}