<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

use C14r\Woocommerce\V3\Enums\Period;

trait Reports
{
    /**
     * API-Request for reports/sales

     * @return API
     */
    public function reportSales(): self
    {
        return $this->endpoint('reports/sales');
    }

    /**
     * API-Request for reports/top_sellers

     * @return API
     */
    public function reportTopSellers(Period $period = Period::last_month): self
    {
        return $this->endpoint('reports/top_sellers')->query('period', $period->value);
    }

    /**
     * API-Request for reports

     * @return API
     */
    public function reports(): self
    {
        return $this->endpoint('reports');
    }

    /**
     * API-Request for reports/orders/totals

     * @return API
     */
    public function reportOrderTotals(): self
    {
        return $this->endpoint('reports/orders/totals');
    }

    /**
     * API-Request for reports/coupons/totals
     * 
     * @return API
     */
    public function reportCouponTotals(): self
    {
        return $this->endpoint('reports/coupons/totals');
    }

    /**
     * API-Request for reports/customers/totals
     * 
     * @return API
     */
    public function reportsCustomerTotals(): self
    {
        return $this->endpoint('reports/customers/totals');
    }

    /**
     * API-Request for reports/products/totals
     * 
     * @return API
     */
    public function reportsProductTotals(): self
    {
        return $this->endpoint('reports/products/totals');
    }

    /**
     * API-Request for reports/reviews/totals
     * 
     * @return API
     */
    public function reportsReviewTotals(): self
    {
        return $this->endpoint('reports/reviews/totals');
    }

}