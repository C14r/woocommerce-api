<?php

namespace C14r\Woocommerce\V3\Services;

class ProductService extends Service
{
    /**
     * Retrieve an order with customer information.
     *
     * @param int $order_id The ID of the order.
     * @return object The order object with customer information.
     */
    public function getWithCustomer(int $order_id): object
    {
        $order = $this->get($order_id);

        // Check if the order has a customer ID and fetch the customer data from the API.
        $order->customer = ($order->customer_id) ? $this->api->customer($order->customer_id)->get() : null;

        return $order;
    }

    /**
     * Retrieve an order.
     *
     * @param int $order_id The ID of the order.
     * @return object The order object.
     */
    public function get(int $order_id): object
    {
        return $this->api->order($order_id)->get();
    }

    /**
     * Update an order with the given data.
     *
     * @param int $order_id The ID of the order.
     * @param array $data The data to update the order with.
     * @return self The ProductService instance.
     */
    public function update(int $order_id, array $data): self
    {
        // Update the order using the API.
        return tap($this, function ($service) use ($order_id, $data) {
            $service->api->order($order_id)->update($data);
        });
    }
}
