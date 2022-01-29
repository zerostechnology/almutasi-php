<?php

namespace Almutasi;

use Exception;
use GuzzleHttp\Client;
use Almutasi\Support\Constant;

class Main
{
	protected $mode;
	protected $apiToken;

	public $privateKey;
	public $http;
	public $initialized = false;

	public function __construct(string $mode = 'sandbox', string $apiToken, string $privateKey)
	{
		$this->mode = $mode;
		$this->apiToken = $apiToken;
		$this->privateKey = $privateKey;
	}

	public function init()
	{
		$this->http = new Client([
			'base_uri' => ($this->mode === 'sandbox')
				? Constant::URL_SANDBOX
				: Constant::URL_PRODUCTION,
			'http_errors' => false,
			'headers' => [
				'Authorization' => 'Bearer '.$this->apiToken
			]
		]);

		$this->initialized = true;
		
		return $this;
	}

	public function __call($method, $args)
	{
		if (! $this->initialized) {
			throw new Exception('Please call `init()` method before using another method');
		}

		$camel_case_method = ucwords($method, '_');
		$camel_case_method = str_replace('_', '', $camel_case_method);

		$class = __NAMESPACE__."\\Service\\".$camel_case_method;

		if (class_exists($class)) {
			return (new $class($this));
		}

		throw new Exception('Call to undefined method '.get_class($this).'::'.$method.'()');
	}
}