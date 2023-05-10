<?php

namespace C14r\Woocommerce\V3\Enums;

enum OrderByOrder: string
{
    case date = 'date';
    case id = 'id';
    case include = 'include';
    case title = 'title';
    case slug = 'slug';
}