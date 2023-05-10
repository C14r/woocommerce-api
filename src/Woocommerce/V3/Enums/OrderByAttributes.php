<?php

namespace C14r\Woocommerce\V3\Enums;

enum OrderByAttributes: string
{
    case menu_order = 'menu_order';
    case name = 'name';
    case name_num = 'name_num';
    case id = 'id';
}