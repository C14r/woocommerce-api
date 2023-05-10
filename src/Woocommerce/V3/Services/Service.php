<?php

namespace C14r\Woocommerce\V3\Services;

use C14r\Woocommerce\V3\API;

abstract class Service
{
    protected API $api;

    public function __construct()
    {
        $this->api = API::getInstance();
    }
}