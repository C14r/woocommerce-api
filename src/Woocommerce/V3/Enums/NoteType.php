<?php

namespace C14r\Woocommerce\V3\Enums;

enum NoteType: string
{
    case any = 'any';
    case customer = 'customer';
    case internal = 'internal';
}