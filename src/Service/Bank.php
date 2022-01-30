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
		$query = http_build_query($query);

		return $this->parent->request('GET', 'bank/logins?'.$query);
	}

	public function accounts(array $query = [])
	{
		$query = http_build_query($query);

		return $this->parent->request('GET', 'bank/accounts?'.$query);
	}

	public function mutations(array $query = [])
	{
		$query = http_build_query($query);

		return $this->parent->request('GET', 'bank/mutations?'.$query);
	}
}