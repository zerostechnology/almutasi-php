<?php

namespace Almutasi\Service;

use Almutasi\Main;

class Account
{
    private $parent;

    public function __construct(Main $parent)
    {
        $this->parent = $parent;
    }

    public function balance()
    {
        return $this->parent->request('GET', 'account/balance');
    }
}
