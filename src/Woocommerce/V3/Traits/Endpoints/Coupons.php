<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

/**
 * Trait Coupons
 *
 * Provides API requests related to coupons.
 */
trait Coupons
{
    /**
     * Creates an API request for retrieving coupons.
     *
     * @return self The API instance.
     */
    public function coupons(): self
    {
        return $this->endpoint('coupons');
    }

    /**
     * Creates an API request for retrieving a specific coupon.
     *
     * @param int $id The unique identifier for the coupon.
     *
     * @return self The API instance.
     */
    public function coupon(int $id): self
    {
        return $this->endpoint('coupons/:id')->parameters(compact('id'));
    }

    /**
     * Creates an API request for performing batch operations on coupons.
     *
     * @return self The API instance.
     */
    public function couponBatch(): self
    {
        return $this->endpoint('coupons/batch');
    }
}
