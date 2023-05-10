<?php

namespace C14r\Woocommerce\V3\Enums;

enum OrderByCustomers: string
{
    case id = 'id';
    case include = 'include';
    case name = 'name';
    case registered_date = 'registered_date';
}