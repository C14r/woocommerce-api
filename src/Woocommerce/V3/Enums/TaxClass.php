<?php

namespace C14r\Woocommerce\V3\Enums;

enum TaxClass: string
{
    case standard = 'standard';
    case reduced_rate = 'reduced-rate';
    case zero_rate = 'zero-rate';
}