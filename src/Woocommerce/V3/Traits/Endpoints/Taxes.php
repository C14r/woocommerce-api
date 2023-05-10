<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait Taxes
{
    /**
     * API-Request for taxes/classes

     * @return API
     */
    public function taxClasses(): self
    {
        return $this->endpoint('taxes/classes');
    }

    /**
     * API-Request for taxes/classes/:slug

     * @param string $slug Unique slug for the resource.
     * @return API
     */
    public function taxClass(string $slug): self
    {
        return $this->endpoint('taxes/classes/:slug')->parameters(compact('slug'));
    }

    /**
     * API-Request for taxes

     * @return API
     */
    public function taxes(): self
    {
        return $this->endpoint('taxes');
    }

    /**
     * API-Request for taxes/:id

     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function tax(int $id): self
    {
        return $this->endpoint('taxes/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for taxes/batch

     * @return API
     */
    public function taxBatch(): self
    {
        return $this->endpoint('taxes/batch');
    }
}