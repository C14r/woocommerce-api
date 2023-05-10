<?php

namespace C14r\Woocommerce\V3\Enums;

enum ShippingZonesLocationsType: string
{
    case postcode = 'postcode';
    case state = 'state';
    case country = 'country';
    case continent = 'continent';
}