<?php

namespace Almutasi;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use Almutasi\Support\Constant;

class Main
{
    protected $mode;
    protected $apiKey;
    protected $headers = [];
    protected $debug = false;

    public $privateKey;
    public $http;

    public function __construct(string $mode = 'sandbox', string $apiKey, string $privateKey)
    {
        $this->mode = $mode;
        $this->apiKey = $apiKey;
        $this->privateKey = $privateKey;

        $this->http = new Client([
            'base_uri' => ($this->mode === 'sandbox')
                ? Constant::URL_SANDBOX
                : Constant::URL_PRODUCTION,
            'http_errors' => false,
            'allow_redirects' => false,
        ]);

        $this->headers = array_merge($this->headers, [
            'Authorization' => 'Bearer '.$this->apiKey,
            'Accept' => 'application/json'
        ]);
    }

    public function debug()
    {
        $this->debug = true;
        return $this;
    }

    public function request(string $method, string $path, array $payload = [])
    {
        $method = strtolower($method);
        $http_status_code = 0;
        $url = null;

        try {
            $response = $this->http->{$method}(ltrim($path, '/'), [
                    'headers' => $this->headers,
                    'form_data' => $payload,
                    'on_stats' => function (TransferStats $stats) use (&$url) {
                        $url = $stats->getEffectiveUri()->__toString();
                    }
                ]);

            $http_status_code = (int) $response->getStatusCode();

            $body = $response->getBody()->getContents();

            $data = json_decode($body);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON response');
            }

            $result = $data;
        } catch (Exception $e) {
            $result = (object) [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        if (! $this->debug) {
            return $result;
        }

        return (object) [
            'request' => [
                'method' => strtoupper($method),
                'url' => $url,
                'header' => $this->headers,
                'body' => $payload,
            ],
            'response' => [
                'http_status_code' => $http_status_code,
                'body' => (array) $result
            ]
        ];
    }

    public function __call($method, $args)
    {
        $camel_case_method = ucwords($method, '_');
        $camel_case_method = str_replace('_', '', $camel_case_method);

        $class = __NAMESPACE__."\\Service\\".$camel_case_method;

        if (class_exists($class)) {
            return (new $class($this));
        }

        throw new Exception('Call to undefined method '.get_class($this).'::'.$method.'()');
    }
}
