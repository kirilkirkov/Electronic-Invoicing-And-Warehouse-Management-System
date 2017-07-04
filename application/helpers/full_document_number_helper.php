<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function full_document_number($inv, $length = 10, $padding = '0')
{
    return str_pad(intval($inv), intval($length), $padding, STR_PAD_LEFT);
}
