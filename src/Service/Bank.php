<?php

namespace Almutasi\Service;

use Almutasi\Main;

class Bank
{
	private $parent;

	public function __construct(Main $parent)
	{
		$this->parent = $parent;
	}

	public function logins(array $query = [])
	{
		return $this->parent->http->get('bank/logins?'.http_build_query($query))
			->getBody()
			->getContents();
	}

	public function accounts(array $query = [])
	{
		return $this->parent->http->get('bank/accounts?'.http_build_query($query))
			->getBody()
			->getContents();
	}

	public function mutations(array $query = [])
	{
		return $this->parent->http->get('bank/mutations?'.http_build_query($query))
			->getBody()
			->getContents();
	}
}