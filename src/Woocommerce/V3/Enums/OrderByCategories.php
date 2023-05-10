<?php

namespace C14r\Woocommerce\V3\Enums;

enum OrderByCategories: string
{
    case id = 'id';
    case include = 'include';
    case name = 'name';
    case slug = 'slug';
    case term_group = 'term_group';
    case description = 'description';
    case count = 'count';
}