<?php

namespace C14r\Woocommerce\V3\Enums;

enum WebhookStatus: string
{
    case all = 'all';
    case active = 'active';
    case paused = 'paused';
    case disabled = 'disabled';
}