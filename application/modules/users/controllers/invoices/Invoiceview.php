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

    public function index($invNum)
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $invoice = $this->NewInvoiceModel->getInvoiceByNumber($invNum);
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
        $this->render('invoices/view', $head, $data);
        $this->saveHistory('Go to preview invoice with number ' . $invNum . ' and firm id' . SELECTED_COMPANY_ID);
    }

    public function viewInvoiceAsPdf()
    {
        
    }

    public function viewInvoiceAsImage()
    {
        
    }

}
