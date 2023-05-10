<?php

namespace C14r\Woocommerce\V3\Enums;

enum CustomerRole: string
{
    case all = 'all';
    case administrator = 'administrator';
    case editor = 'editor';
    case author = 'author';
    case contributor = 'contributor';
    case subscriber = 'subscriber';
    case customer = 'customer';
    case shop_manager = 'shop_manager';
}