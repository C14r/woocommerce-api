<?php

namespace C14r\Woocommerce\V3\Enums;

enum ProductStatus: string
{
    case draft = 'draft';
    case pending = 'pending';
    case private = 'private';
    case publish = 'publish';
}