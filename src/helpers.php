<?php

use C14r\Woocommerce\V3\API;

if (! function_exists('woo')) {
    function woo(?string $connection = null): API
    {
        return resolve('woo', ['connection' => $connection]);
    }
}