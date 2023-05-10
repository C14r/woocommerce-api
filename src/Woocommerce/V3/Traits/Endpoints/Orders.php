<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait Orders
{
    /**
     * API-Request for orders/:order_id/notes

     * @param int $order_id The order ID.
     * @return API
     */
    public function orderNotes(int $order_id): self
    {
        return $this->endpoint('orders/:order_id/notes')->parameters(compact('order_id'));
    }

    /**
     * API-Request for orders/:order_id/notes/:id

     * @param int $order_id The order ID.
     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function orderNote(int $order_id, int $id): self
    {
        return $this->endpoint('orders/:order_id/notes/:id')->parameters(compact('order_id', 'id'));
    }

    /**
     * API-Request for orders/:order_id/refunds

     * @param int $order_id The order ID.
     * @return API
     */
    public function orderRefunds(int $order_id): self
    {
        return $this->endpoint('orders/:order_id/refunds')->parameters(compact('order_id'));
    }

    /**
     * API-Request for orders/:order_id/refunds/:id

     * @param int $order_id The order ID.
     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function orderRefund(int $order_id, int $id): self
    {
        return $this->endpoint('orders/:order_id/refunds/:id')->parameters(compact('order_id', 'id'));
    }

    /**
     * API-Request for orders

     * @return API
     */
    public function orders(): self
    {
        return $this->endpoint('orders');
    }

    /**
     * API-Request for orders/:id

     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function order(int $id): self
    {
        if($this->hasEndpoint())
        {
            return $this->query('order', $id);
        }

        return $this->endpoint('orders/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for orders/batch

     * @return API
     */
    public function orderBatch(): self
    {
        return $this->endpoint('orders/batch');
    }
}