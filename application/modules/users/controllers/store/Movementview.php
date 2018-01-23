<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Movementview extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('StoreModel'));
    }

    public function index($movementNumber)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_movem_prev');

        $movement = $this->StoreModel->getMovementByNumber($movementNumber);
        if ($movement == null) {
            log_message('error', 'User with id - ' . USER_ID . ' gets 404 when try to open movement with number - ' . $movementNumber);
            show_404();
        }
        $data['movement'] = $movement;
        $this->render('store/preview', $head, $data);
        $this->saveHistory('Go to preview movement with number ' . $movementNumber . ' and firm id' . SELECTED_COMPANY_ID);
    }

    public function viewMovementAsPdf($movementNumber)
    {
        $movement = $this->StoreModel->getMovementByNumber($movementNumber);
        if ($movement == null) {
            log_message('error', 'User with id - ' . USER_ID . ' gets 404 when try to view as PDF movement with number - ' . $movementNumber);
            show_404();
        }
        $choosedTemplate = 'default';
        $templatesDir = 'application/modules/users/views/store/templates/';
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
        <link href="' . base_url('assets/users/css/bill-of-lading-templates.css') . '" rel="stylesheet">   
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
        $this->htmltopdf->setNum($movementNumber); // set movement number to give it to footer
        $this->htmltopdf->setType($movement['translation']['bill_of_goods']);
        $this->htmltopdf->setPageTranslate($movement['translation']['page']); // set movement translation of 'page' word
        $pdf = $this->htmltopdf->generatePdf($html);
        $filename = 'bill_of_lading - ' . $movementNumber . '.pdf';

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
