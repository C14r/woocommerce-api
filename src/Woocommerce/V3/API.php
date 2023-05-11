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

/**
 * Class API
 *
 * Represents an API client for handling WooCommerce requests.
 */
class API extends Request
{
    /**
     * An array containing instances of the API class.
     *
     * @var array
     */
    private static array $instances = [];

    // Endpoints
    use Coupons, Customers, Orders, Products, Reports, Settings, Shipping, Taxes, Webhooks, SystemStatus, Germanized;

    // Helpers
    use QueryHelpers, Cache, All;

    /**
     * API constructor.
     *
     * @param string|null $connection The connection name.
     */
    public function __construct(?string $connection = null)
    {
        parent::__construct($this->getClient($connection));
    }

    /**
     * Retrieves the HTTP client for making requests.
     *
     * @param string|null $connection The connection name.
     *
     * @return Client The HTTP client.
     */
    private function getClient(?string $connection = null): Client
    {
        if (is_null($connection)) {
            $connection = config('woocommerce.default', 'default');
        }

        $path = 'woocommerce.connections.' . $connection;

        return new Client(
            config($path . '.url'),
            config($path . '.key'),
            config($path . '.secret'),
            config($path . '.options', [])
        );
    }

    /**
     * Retrieves a singleton instance of the API class.
     *
     * @param mixed $connection The connection name or an array containing connection information.
     *
     * @return static The API instance.
     */
    public static function getInstance($connection = null): static
    {
        if (is_array($connection) && isset($connection['connection'])) {
            $connection = $connection['connection'];
        } elseif (is_array($connection)) {
            $connection = null;
        }

        if (!isset(static::$instances[$connection])) {
            static::$instances[$connection] = new static($connection);
        }

        return static::$instances[$connection];
    }
}
