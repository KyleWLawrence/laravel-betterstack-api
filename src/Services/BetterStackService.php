<?php

namespace KyleWLawrence\BetterStack\Services;

use BadMethodCallException;
use Config;
use InvalidArgumentException;
use KyleWLawrence\BetterStack\Http\HttpClient;

class BetterStackService
{
    /**
     * Get auth parameters from config, fail if any are missing.
     * Instantiate API client and set auth bearer token.
     *
     * @throws Exception
     */
    public function __construct(
        private string $token = '',
        public HttpClient $client = new HttpClient,
    ) {
        $this->token = ($this->token) ? $this->token : config('betterstack-laravel.token');

        if (! $this->token) {
            throw new InvalidArgumentException('Please set BETTERSTACK_TOKEN environment variables.');
        }

        $this->client->setAuth('bearer', ['token' => $this->token]);
    }

    /**
     * Pass any method calls onto $this->client
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (is_callable([$this->client, $method])) {
            return call_user_func_array([$this->client, $method], $args);
        } else {
            throw new BadMethodCallException("Method $method does not exist");
        }
    }

    /**
     * Pass any property calls onto $this->client
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this->client, $property)) {
            return $this->client->{$property};
        } else {
            throw new BadMethodCallException("Property $property does not exist");
        }
    }
}
