<?php

namespace C14r\Woocommerce\V3\Enums;

enum OrderStatus: string
{
    case any = 'any';
    case pending = 'pending';
    case processing = 'processing';
    case on_hold = 'on-hold';
    case completed = 'completed';
    case cancelled = 'cancelled';
    case refunded = 'refunded';
    case failed = 'failed';
}