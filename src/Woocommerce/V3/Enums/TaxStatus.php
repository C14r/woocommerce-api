<?php

namespace C14r\Woocommerce\V3\Enums;

enum TaxStatus: string
{
    case taxable = 'taxable';
    case shipping = 'shipping';
    case none = 'none';
}