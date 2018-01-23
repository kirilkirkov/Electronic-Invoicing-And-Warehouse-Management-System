<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Protocolview extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProtocolsModel');
    }

    public function index()
    {
        show_404();
    }

    public function viewProtocolAsPdf($number)
    {
        $protocol = $this->ProtocolsModel->getProtocolByNumber($number);
        if ($protocol == null) {
            log_message('error', 'User with id - ' . USER_ID . ' gets 404 when try to open as PDF protocol with number - ' . $number);
            show_404();
        }
        $choosedTemplate = 'default';
        $templatesDir = 'application/modules/users/views/protocols/templates/';
        $templateFile = $templatesDir . $choosedTemplate . '.php';
        if (!is_file($templateFile)) {
            show_error(lang('no_template_file'));
        }
        $this->load->library('HtmlToPdf');
        ob_start();
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administration - Home</title> 
        <link href="' . base_url('assets/bootstrap/css/bootstrap.min.css') . '" rel="stylesheet">
        <link href="' . base_url('assets/users/css/protocols-templates.css') . '" rel="stylesheet">   
        <script src="' . base_url('assets/jquery/jquery.min.js') . '"></script>  
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body> 
    ';
        include $templateFile;
        echo '</body></html>';
        $html = ob_get_clean();
        $this->htmltopdf->setNum($number); // set $protocol number to give it to footer
        $this->htmltopdf->setType($protocol['translation']['transmission_protocol']);
        $this->htmltopdf->setPageTranslate($protocol['translation']['page']); // set $protocol translation of 'page' word
        $pdf = $this->htmltopdf->generatePdf($html);
        $filename = 'protocol - ' . $number . '.pdf';

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . strlen($pdf));
        echo $pdf;
        exit;
    }

}
