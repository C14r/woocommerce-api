<?php

namespace C14r\Woocommerce\V3\Enums;

enum CouponsDiscountType: string
{
    case percent = 'percent';
    case fixed_cart = 'fixed_cart';
    case fixed_product = 'fixed_product';
}