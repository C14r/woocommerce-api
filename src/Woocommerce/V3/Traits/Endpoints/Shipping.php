<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait Shipping
{
    /**
     * API-Request for shipping/zones

     * @return API
     */
    public function shippingZones(): self
    {
        return $this->endpoint('shipping/zones');
    }

    /**
     * API-Request for shipping/zones/:id

     * @param int $id Unique ID for the resource.
     * @return API
     */
    public function shippingZone(int $id): self
    {
        return $this->endpoint('shipping/zones/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for shipping/zones/:id/locations

     * @param int $id Unique ID for the resource.
     * @return API
     */
    public function shippingZoneLocations(int $id): self
    {
        return $this->endpoint('shipping/zones/:id/locations')->parameters(compact('id'));
    }

    /**
     * API-Request for shipping/zones/:zone_id/methods

     * @param int $zone_id Unique ID for the zone.
     * @return API
     */
    public function shippingZoneMethods(int $zone_id): self
    {
        return $this->endpoint('shipping/zones/:zone_id/methods')->parameters(compact('zone_id'));
    }

    /**
     * API-Request for shipping/zones/:zone_id/methods/:instance_id

     * @param int $zone_id Unique ID for the zone.
     * @param int $instance_id Unique ID for the instance.
     * @return API
     */
    public function shippingZoneMethod(int $zone_id, int $instance_id): self
    {
        return $this->endpoint('shipping/zones/:zone_id/methods/:instance_id')->parameters(compact('zone_id', 'instance_id'));
    }

    /**
     * API-Request for shipping_methods

     * @return API
     */
    public function shippingMethods(): self
    {
        return $this->endpoint('shipping_methods');
    }

    /**
     * API-Request for shipping_methods/:id

     * @param string $id Unique identifier for the resource.
     * @return API
     */
    public function shippingMethod(string $id): self
    {
        return $this->endpoint('shipping_methods/:id')->parameters(compact('id'));
    }
}