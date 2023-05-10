<?php

namespace C14r\Woocommerce\V3\Services;

class ProductService extends Service
{
    public function getWithCustomer(int $order_id): object
    {
        $order = $this->get($order_id);

        $order->customer = ($order->customer_id) ? $this->api->customer($order->customer_id)->get() : null;

        return $order;
    }
    
    public function get(int $order_id): object
    {
        return $this->api->order($order_id)->get();
    }

    public function update(int $order_id, array $data): self
    {
        return tap($this, function($service) use ($order_id, $data) {
            $service->api->order($order_id)->update($data);
        });
    }
}