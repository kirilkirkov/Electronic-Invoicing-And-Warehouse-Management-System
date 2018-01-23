<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Constant LANG_URL is comming from class Language
 * This function returns the full url with selected language
 * Can be used for links.. like navigation or others..
 */

function lang_url($goto = null)
{
    if ($goto != null) {
        $goto = '/' . ltrim($goto, '/');
    }
    return trim(LANG_URL) . trim($goto);
}
