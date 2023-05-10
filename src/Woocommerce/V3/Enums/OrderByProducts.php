<?php

namespace C14r\Woocommerce\V3\Enums;

enum OrderByProducts: string
{
    case date = 'date';
    case id = 'id';
    case include = 'include';
    case title = 'title';
    case slug = 'slug';
    case price = 'price';
    case popularity = 'popularity';
    case rating = 'rating';
}