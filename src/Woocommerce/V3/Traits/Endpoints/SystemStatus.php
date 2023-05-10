<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait SystemStatus
{
    /**
     * API-Request for system_status

     * @return API
     */
    public function systemStatus(): self
    {
        return $this->endpoint('system_status');
    }

    /**
     * API-Request for system_status/tools

     * @return API
     */
    public function systemStatusTools(): self
    {
        return $this->endpoint('system_status/tools');
    }

    /**
     * API-Request for system_status/tools/:id

     * @param string $id Unique identifier for the resource.
     * @return API
     */
    public function systemStatusTool(string $id): self
    {
        return $this->endpoint('system_status/tools/:id')->parameters(compact('id'));
    }
}