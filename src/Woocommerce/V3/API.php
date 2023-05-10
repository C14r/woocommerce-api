<?php

namespace C14r\Woocommerce\V3;

use Automattic\WooCommerce\Client;
use C14r\Woocommerce\Request;
use C14r\Woocommerce\V3\Traits\All;
use C14r\Woocommerce\V3\Traits\Cache;
use C14r\Woocommerce\V3\Traits\QueryHelpers;
use C14r\Woocommerce\V3\Traits\Endpoints\Coupons;
use C14r\Woocommerce\V3\Traits\Endpoints\Customers;
use C14r\Woocommerce\V3\Traits\Endpoints\Germanized;
use C14r\Woocommerce\V3\Traits\Endpoints\Orders;
use C14r\Woocommerce\V3\Traits\Endpoints\Products;
use C14r\Woocommerce\V3\Traits\Endpoints\Reports;
use C14r\Woocommerce\V3\Traits\Endpoints\Settings;
use C14r\Woocommerce\V3\Traits\Endpoints\Shipping;
use C14r\Woocommerce\V3\Traits\Endpoints\SystemStatus;
use C14r\Woocommerce\V3\Traits\Endpoints\Taxes;
use C14r\Woocommerce\V3\Traits\Endpoints\Webhooks;

class API extends Request
{
    private static array $instances = [];

    // Endpoints
    use Coupons, Customers, Orders, Products, Reports, Settings, Shipping, Taxes, Webhooks, SystemStatus, Germanized;

    // Helpers
    use QueryHelpers, Cache, All;

    public function __construct(?string $connection = null)
    {
        parent::__construct($this->getClient($connection));
    }

    private function getClient(?string $connection = null): Client
    {
        if (is_null($connection)) {
            $connection = config('woocommerce.default', 'default');
        }

        $path = 'woocommerce.connections.' . $connection;

        return new Client(
            config($path.'.url'),
            config($path.'.key'),
            config($path.'.secret'),
            config($path.'.options', [])
        );
    }

    public static function getInstance($connection = null): static
    {
        if (is_array($connection) && isset($connection['connection'])) {
            $connection = $connection['connection'];
        }
        elseif(is_array($connection))
        {
            $connection = null;
        }

        if (!isset(static::$instances[$connection])) {
            static::$instances[$connection] = new static($connection);
        }
        return static::$instances[$connection];
    }
}
