<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait PaymentGateways
{
    /**
     * API-Request for payment_gateways

     * @return API
     */
    public function paymentGateways(): self
    {
        return $this->endpoint('payment_gateways');
    }

    /**
     * API-Request for payment_gateways/:id

     * @param string $id Unique identifier for the resource.
     * @return API
     */
    public function paymentGateway(string $id): self
    {
        return $this->endpoint('payment_gateways/:id')->parameters(compact('id'));
    }
}