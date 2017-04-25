<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function uploader($path, $inputName = false)
{
    if ($inputName === false) {
        $iName = 'input_file';
    } else {
        $iName = $inputName;
    }

    $ci = & get_instance();
    if ($_FILES[$iName]['size'] == 0) {
        return false;
    }
    $config = array();
    $config['upload_path'] = $path;
    $config['allowed_types'] = $ci->config->item('allowed_img_types');
    $ci->load->library('upload', $config);
    $ci->upload->initialize($config);
    if (!$ci->upload->do_upload($iName)) {
        log_message('error', 'Image Upload Error: ' . $ci->upload->display_errors());
        return array('result' => false, 'value' => $ci->upload->display_errors());
    }
    $img = $ci->upload->data();
    if ($img['file_name'] != null) {
        return array('result' => true, 'value' => $img['file_name']);
    }
    return false;
}
