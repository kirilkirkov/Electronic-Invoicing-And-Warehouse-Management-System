<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * return first day and last day from this year
 */

function thisyeardates()
{
    $array = array();
    $date = new DateTime('now');
    $date->modify('first day of January ' . date('Y'));
    $array['from'] = $date->format('d.m.Y');

    $date = new DateTime('now');
    $date->modify('last day of December ' . date('Y'));
    $array['to'] = $date->format('d.m.Y');
    return $array;
}
