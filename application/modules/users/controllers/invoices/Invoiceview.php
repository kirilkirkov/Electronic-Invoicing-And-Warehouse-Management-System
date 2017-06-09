<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Invoiceview extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('NewInvoiceModel');
    }

    public function index($invType, $invNum)
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $inv_readable_types_flip = array_flip($this->config->item('inv_readable_types'));
        $invoice = $this->NewInvoiceModel->getInvoiceByNumber($inv_readable_types_flip[$invType], $invNum);
        if ($invoice == null) {
            show_404();
        }
        $choosedTemplate = 'creative';
        $templatesDir = 'application/modules/users/views/invoices/templates/';
        $templateFile = $templatesDir . $choosedTemplate . '.php';
        if (!is_file($templateFile)) {
            show_error(lang('no_template_file'));
        }
        $data['invoice'] = $invoice;
        $data['templateFile'] = $templateFile; 
        $data['invType'] = $invType;
        $data['invNum'] = $invNum;
        $this->render('invoices/view', $head, $data);
        $this->saveHistory('Go to preview invoice with number ' . $invNum . ' and firm id' . SELECTED_COMPANY_ID);
    }

    public function viewInvoiceAsPdf($invType, $invNum)
    {
        $inv_readable_types = array_flip($this->config->item('inv_readable_types'));
        $invoice = $this->NewInvoiceModel->getInvoiceByNumber($inv_readable_types[$invType], $invNum);
        if ($invoice == null) {
            show_404();
        }
        $choosedTemplate = 'creative';
        $templatesDir = 'application/modules/users/views/invoices/templates/';
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
        <script src="' . base_url('assets/jquery/jquery.min.js') . '"></script>  
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <link rel="stylesheet" href="' . base_url('assets/users/css/invoices-templates.css') . '">   
    ';
        include $templateFile;
        echo '</body></html>';
        $html = ob_get_clean();
        $pdf = $this->htmltopdf->generatePdf($html);

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="platejno.pdf"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . strlen($pdf));
        echo $pdf;
        exit;
    }

}
