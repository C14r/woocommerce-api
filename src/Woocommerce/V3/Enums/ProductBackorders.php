<?php

namespace C14r\Woocommerce\V3\Enums;

enum ProductBackorders: string
{
    case no = 'no';
    case notify = 'notify';
    case yes = 'yes';
}