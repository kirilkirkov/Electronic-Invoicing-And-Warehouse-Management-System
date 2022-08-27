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
        $cssInvTemplates = file_get_contents(base_url('assets/users/css/invoices-templates.css'));
        $cssFonts = APPPATH . 'libraries/dompdf/lib/fonts/DejaVuSans.ttf';

        ob_start();
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Invoice ' . $invoice['inv_number'] . '</title> 
        <style>
            @font-face {
            font-family: \'DejaVu Sans\';
            font-style: normal; 
            src: url(\'' . $cssFonts . '\') format(\'truetype\');
          }
          .invoice-box * {
            font-family: \'DejaVu Sans\';
          }
        ' . $cssInvTemplates . '
        </style>  
    </head>
    <body> 
    ';
        include $templateFile;
        echo '</body></html>';
        $html = ob_get_clean();
        
        // DEBUG: preview real html
        // echo $html; exit;

        // lets use dompdf lib to generate it.
        require_once APPPATH . 'libraries/dompdf/autoload.inc.php';
        $dompdf = new \Dompdf\Dompdf();

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        // [0, 0, 867.00, 1008.00]
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        
        // Output the generated PDF to Browser
        $dompdf->stream($invoice['inv_number']);
        die();
    }

    public function getInvoiceByNumber($invType, $invNum)
    {
        return $this->NewInvoiceModel->getInvoiceByNumber($invType, $invNum);
    }

}
