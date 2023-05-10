<?php

namespace C14r\Woocommerce\V3\Enums;

enum CatalogVisibility: string
{
    case visible = 'visible';
    case catalog = 'catalog';
    case search = 'search';
    case hidden = 'hidden';
}