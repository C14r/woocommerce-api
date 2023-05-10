<?php

declare(strict_types=1);

namespace C14r\Woocommerce;

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Request
{
    public Client $client;

    protected string $endpoint;
    protected array $parameters = [];
    protected array $attributes = [];
    protected array $query = [];
    protected array $headers = [];

    protected bool $do_clear = true;

    /**
     * Constructor
     *
     * @param \Automattic\WooCommerce\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getHeader(string $key): mixed
    {
        return Arr::get($this->client->http->getResponse()->getHeaders(), $key, null);
    }

    /**
     * Sets the new endpoint.
     *
     * @param string $endpoint
     * @return self
     */
    public function endpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }
    
    /**
     * Sets a parameter for the request.
     *
     * @param string $key   The parameter
     * @param mixed $value  Value of the parameter
     * @return self
     */
    public function parameter(string $key, mixed $value): self
    {
        return $this->set('parameters', $key, $value);
    }
    
    /**
     * Sets multiple parameters for the request.
     *
     * @param array|object $values A set of key-value-pairs.
     * @return self
     */
    public function parameters(array|object $values): self
    {
        return $this->setArray('parameters', $values);
    }

    /**
     * Sets a attribute for the request.
     *
     * @param string $key   The attribute
     * @param mixed $value  Value of the attribute
     * @return self
     */
    public function attribute(string $key, mixed $value): self
    {
        return $this->set('attributes', $key, $value);
    }
    
    /**
     * Sets multiple attributes for the request.
     *
     * @param array|object $values A set of key-value-pairs.
     * @return self
     */
    public function attributes(array|object $values): self
    {
        return $this->setArray('attributes', $values);
    }

    /**
     * Sets a query-parameter for the request.
     *
     * @param string $key   The query-parameter
     * @param mixed $value  Value of the query-parameter
     * @return self
     */
    public function query(string $key, mixed $value): self
    {
        return $this->set('query', $key, $value);
    }

    /**
     * Sets multiple query-parameters for the request.
     *
     * @param array|object $values A set of key-value-pairs.
     * @return self
     */
    public function queries(array|object $values): self
    {
        return $this->setArray('query', $values);
    }
    
    /**
     * Sets a header for the request.
     *
     * @param string $key   The header
     * @param mixed $value  Value of the header
     * @return self
     */
    public function header(string $key, mixed $value): self
    {
        return $this->set('headers', $key, $value);
    }
    
    /**
     * Sets multiple headers for the request.
     *
     * @param array|object $values A set of key-value-pairs.
     * @return self
     */
    public function headers(array|object $values): self
    {
        return $this->setArray('headers', $values);
    }

    /**
     * Performs a POST-request (alias).
     *
     * @param array|object $data
     * @return object
     */
    public function create(array|object $data = []): object
    {
        return $this->attributes($data)->post();
    }

    /**
     * Performs a PATCH-request (alias).
     *
     * @param array|object $data
     * @return object
     */
    public function update(array|object $data = []): object
    {
        return $this->attributes($data)->patch();
    }

    /**
     * Performs a GET-request.
     *
     * @return object|array
     */
    public function get(): object|array
    {
        return $this->request('GET');
    }

    /**
     * Performs a POST-request.
     *
     * @return object|array
     */
    public function post(): object|array
    {
        return $this->request('POST');
    }

    /**
     * Performs a PATCH-request.
     *
     * @return object|array
     */
    public function patch(): object|array
    {
        return $this->request('PATCH');
    }

    /**
     * Performs a DELETE-request.
     *
     * @return object|array
     */
    public function delete(): object|array
    {
        return $this->request('DELETE');
    }

    /**
     * Performs the actual HTTP-request.
     *
     * @param string $method    HTTP-Method (GET, POST, PATCH, DELETE)
     * @param string $url       URL
     * @param array $options    Headers and data
     * @return ResponseInterface
     */
    protected function performRequest(string $method, string $url, array $options): mixed
    {
        try {
            return $this->client->http->request($url, $method, [], $options);
        } catch (HttpClientException $e) {
            return $e->getResponse();
        }

    }

    protected function request(string $method): object|array
    {
        $response = $this->performRequest($method, $this->buildUrl(), $this->buildOptions() ?? []);
        //$contents = $response->getBody()->getContents();
        //$json = json_decode($contents);

        if($this->do_clear)
        {
            $this->clear();
        }

        return is_array($response) ? collect($response) : $response;
    }

    public function test(): object
    {
        return (object)[
            'url' => $this->buildUrl(),
            'options' => $this->buildOptions()
        ];
    }

    /**
     * Builds the URL for the current request.
     *
     * @return string
     */
    protected function buildUrl(): string
    {
        return $this->replaceParameters($this->endpoint) . '?' . http_build_query($this->query);
    }

    /**
     * Prepares the request parameters
     *
     * @return ?array
     */
    protected function buildOptions(): ?array
    {
        return !empty($this->attributes) ? $this->attributes : null;
    }

    /**
     * Replace variables in the endpoint.
     *
     * @param string $endpoint
     * @return string
     */
    private function replaceParameters(string $endpoint): string
    {
        $url = $endpoint;

        foreach ($this->parameters as $key => $value) {
            $url = str_replace(':' . $key, strval($value), $url);
        }

        return $url;
    }

    /**
     * Sets a variable for the request.
     *
     * @param string $variable  Can be attributes, parameters, query, headers
     * @param string $key
     * @param mixed $value
     * @return self
     */
    private function set(string $variable, string $key, mixed $value): self
    {
        if (!is_null($value)) {
            $this->{$variable}[$key] = $value;
        } elseif (isset($this->{$variable}[$key])) {
            unset($this->{$variable}[$key]);
        }

        return $this;
    }

    /**
     * Sets multiple variables for the request.
     *
     * @param string $variable  Can be attributes, parameters, query, headers
     * @param array|object $array
     * @return self
     */
    private function setArray(string $variable, array|object $array): self
    {
        foreach ($array as $key => $value) {
            $this->set($variable, $key, $value);
        }

        return $this;
    }

    /**
     * Clears all variables beloning to the last request.
     *
     * @return self
     */
    public function clear(): self
    {
        $this->endpoint = '';

        $this->parameters = [];
        $this->attributes = [];
        $this->query = [];
        $this->headers = [];
   
        return $this;
    }

    /**
     * Checks if an endpoint is already set
     * 
     * @return bool
     */
    protected function hasEndpoint(): bool
    {
        return !empty($this->endpoint);
    }
}
