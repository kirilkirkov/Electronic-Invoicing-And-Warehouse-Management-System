<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Return md5 hash with salt
 */

function md5salt($string)
{
    $ci = & get_instance();
    $salt = $ci->config->item('salt');
    return md5($string . $salt);
}
