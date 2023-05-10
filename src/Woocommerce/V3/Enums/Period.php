<?php

namespace C14r\Woocommerce\V3\Enums;

enum Period: string
{
    case week = 'week';
    case month = 'month';
    case last_month = 'last_month';
    case year = 'year';
}