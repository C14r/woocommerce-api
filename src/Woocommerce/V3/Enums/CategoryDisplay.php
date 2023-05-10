<?php

namespace C14r\Woocommerce\V3\Enums;

enum CategoryDisplay: string
{
    case default = 'default';
    case products = 'products';
    case subcategories = 'subcategories';
    case both = 'both';
}