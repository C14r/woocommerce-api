<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait Settings
{
    /**
     * API-Request for settings/:group_id or settings

     * @param string $group_id Settings group ID.
     * @return API
     */
    public function settings(?string $group_id): self
    {
        if (is_null($group_id)) {
            return $this->endpoint('settings');
        }

        if($this->hasEndpoint())
        {
            return $this->query('settings', $group_id);
        }

        return $this->endpoint('settings/:group_id')->parameters(compact('group_id'));
    }

    /**
     * API-Request for settings/:group_id/batch

     * @param string $group_id Settings group ID.
     * @return API
     */
    public function settingBatch(string $group_id): self
    {
        return $this->endpoint('settings/:group_id/batch')->parameters(compact('group_id'));
    }

    /**
     * API-Request for settings/:group_id/:id

     * @param string $group_id Settings group ID.
     * @param string $id Unique identifier for the resource.
     * @return API
     */
    public function setting(string $group_id, string $id): self
    {
        return $this->endpoint('settings/:group_id/:id')->parameters(compact('group_id', 'id'));
    }
}