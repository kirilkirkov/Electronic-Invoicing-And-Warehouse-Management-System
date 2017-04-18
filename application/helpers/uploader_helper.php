<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function uploader($path)
{
    $ci = & get_instance();
    $config = array();
    $config['upload_path'] = $path;
    $config['allowed_types'] = $ci->config->item('allowed_img_types');
    $ci->load->library('upload', $config);
    $ci->upload->initialize($config);
    if (!$ci->upload->do_upload('input_file')) {
        log_message('error', 'Image Upload Error: ' . $ci->upload->display_errors()); 
        return false;
    }
    $img = $ci->upload->data();
    if ($img['file_name'] != null) {
        return $img['file_name'];
    }
    return false;
}
