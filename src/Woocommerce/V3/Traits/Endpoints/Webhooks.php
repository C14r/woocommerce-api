<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait Webhooks
{
    /**
     * API-Request for webhooks/:webhook_id/deliveries

     * @param int $webhook_id Unique identifier for the webhook.
     * @return API
     */
    public function webhookDeliveries(int $webhook_id): self
    {
        return $this->endpoint('webhooks/:webhook_id/deliveries')->parameters(compact('webhook_id'));
    }

    /**
     * API-Request for webhooks/:webhook_id/deliveries/:id

     * @param int $webhook_id Unique identifier for the webhook.
     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function webhookDelivery(int $webhook_id, int $id): self
    {
        return $this->endpoint('webhooks/:webhook_id/deliveries/:id')->parameters(compact('webhook_id', 'id'));
    }

    /**
     * API-Request for webhooks

     * @return API
     */
    public function webhooks(): self
    {
        return $this->endpoint('webhooks');
    }

    /**
     * API-Request for webhooks/:id

     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function webhook(int $id): self
    {
        return $this->endpoint('webhooks/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for webhooks/batch

     * @return API
     */
    public function webhookBatch(): self
    {
        return $this->endpoint('webhooks/batch');
    }
}