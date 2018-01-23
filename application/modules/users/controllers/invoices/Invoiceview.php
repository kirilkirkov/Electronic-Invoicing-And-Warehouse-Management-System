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
        $head['title'] = lang('title_everytime') . lang('title_inv_preview') . $invNum;
        $inv_readable_types_flip = array_flip($this->config->item('inv_readable_types'));
        $invoice = $this->getInvoiceByNumber($inv_readable_types_flip[$invType], $invNum);
        if ($invoice == null) {
            log_message('error', 'User with id - ' . USER_ID . ' get 404 when try to view invoice with type -' . $invType . ' and number - ' . $invNum);
            show_404();
        }
        $this->load->model('SettingsModel');
        $template = $this->SettingsModel->getValueStores('opt_invTemplate');
        $templates = $this->config->item('templates');
        if (!in_array($template, $templates)) {
            $template = $templates[0];
        } else {
            $choosedTemplate = $template;
        }
        $templatesDir = 'application/modules/users/views/invoices/templates/';
        $templateFile = $templatesDir . $choosedTemplate . '.php';
        if (!is_file($templateFile)) {
            show_error(lang('no_template_file'));
        }
        $data['actionHistory'] = $this->NewInvoiceModel->getActionHistory($invoice['id']);
        $data['invoice'] = $invoice;
        $data['templateFile'] = $templateFile;
        $data['invType'] = $invType;
        $data['invNum'] = $invNum;
        $this->render('invoices/view', $head, $data);
        $this->saveHistory('Go to preview invoice with number ' . $invNum . ' and firm id' . SELECTED_COMPANY_ID);
    }

    public function viewInvoiceAsPdf($invType, $origin, $invNum)
    {
        $inv_readable_types = array_flip($this->config->item('inv_readable_types'));
        $invoice = $this->getInvoiceByNumber($inv_readable_types[$invType], $invNum);
        if ($invoice == null) {
            log_message('error', 'User with id - ' . USER_ID . ' get 404 when try to render PDF invoice with type -' . $invType . ' and number - ' . $invNum);
            show_404();
        }
        $this->load->model('SettingsModel');
        $template = $this->SettingsModel->getValueStores('opt_invTemplate');
        $templates = $this->config->item('templates');
        if (!in_array($template, $templates)) {
            $template = $templates[0];
        } else {
            $choosedTemplate = $template;
        }
        $templatesDir = 'application/modules/users/views/invoices/templates/';
        $templateFile = $templatesDir . $choosedTemplate . '.php';
        if (!is_file($templateFile)) {
            show_error(lang('no_template_file'));
        }
        $firmInfo = $this->firmInfo;
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
        <link href="' . base_url('assets/users/css/invoices-templates.css') . '" rel="stylesheet">  
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
        $this->htmltopdf->setNum($invNum); // set invoice number to give it to footer
        if ($invType == 'invoice') {
            $invTypeT = $invoice['translation']['invoice'];
        } elseif ($invType == 'debit-note') {
            $invTypeT = $invoice['translation']['debit_note'];
        } elseif ($invType == 'credit-note') {
            $invTypeT = $invoice['translation']['credit_note'];
        } elseif ($invType == 'pro-forma') {
            $invTypeT = $invoice['translation']['pro_forma'];
        }
        $this->htmltopdf->setType($invTypeT); // set invoice type to give it to footer 
        $this->htmltopdf->setPageTranslate($invoice['translation']['page']); // set invoice translation of 'page' word
		$pdf = $this->htmltopdf->generatePdf($html); 
        $filename = $invType . ' - ' . $invNum . '.pdf';

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . strlen($pdf));
        echo $pdf;
        exit;
    }

    public function getInvoiceByNumber($invType, $invNum)
    {
        return $this->NewInvoiceModel->getInvoiceByNumber($invType, $invNum);
    }

}
