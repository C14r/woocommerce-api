<?php

namespace C14r\Woocommerce\V3\Enums;

enum ProductType: string
{
    case simple = 'simple';
    case grouped = 'grouped';
    case external = 'external';
    case variable = 'variable';
}