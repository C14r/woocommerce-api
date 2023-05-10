<?php

namespace C14r\Woocommerce\V3\Enums;

enum VariationStatus: string
{
    case any = 'any';
    case draft = 'draft';
    case pending = 'pending';
    case private = 'private';
    case publish = 'publish';
}