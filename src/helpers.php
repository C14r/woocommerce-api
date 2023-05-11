<?php

use C14r\Woocommerce\V3\API;

if (!function_exists('woo')) {
    /**
     * Get an instance of the WooCommerce API.
     *
     * @param string|null $connection The connection name. Default is null.
     * @return API The WooCommerce API instance.
     */
    function woo(?string $connection = null): API
    {
        return resolve('woo', ['connection' => $connection]);
    }
}
