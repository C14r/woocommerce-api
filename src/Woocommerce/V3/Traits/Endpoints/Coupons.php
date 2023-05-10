<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait Coupons
{
    /**
     * API-Request for coupons

     * @return API
     */
    public function coupons(): self
    {
        return $this->endpoint('coupons');
    }

    /**
     * API-Request for coupons/:id

     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function coupon(int $id): self
    {
        return $this->endpoint('coupons/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for coupons/batch

     * @return API
     */
    public function couponBatch(): self
    {
        return $this->endpoint('coupons/batch');
    }
}