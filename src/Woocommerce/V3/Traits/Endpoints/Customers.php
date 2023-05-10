<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait Customers
{
    /**
     * API-Request for customers

     * @return API
     */
    public function customers(): self
    {
        return $this->endpoint('customers');
    }

    /**
     * API-Request for customers/:id

     * @param int $id Unique identifier for the customer.
     * @return API
     */
    public function customer(int $id): self
    {
        if($this->hasEndpoint())
        {
            return $this->query('customer', $id);
        }

        return $this->endpoint('customers/:id')->parameters(compact('id'));
    }
    
    /**
     * API-Request for customers/:customer_id/downloads

     * @param int $customer_id Unique identifier for the customer.
     * @return API
     */
    public function customerDownloads(int $customer_id): self
    {
        return $this->endpoint('customers/:customer_id/downloads')->parameters(compact('customer_id'));
    }

    /**
     * API-Request for customers/batch

     * @return API
     */
    public function customerBatch(): self
    {
        return $this->endpoint('customers/batch');
    }
}