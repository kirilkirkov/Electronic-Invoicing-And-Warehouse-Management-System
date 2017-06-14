<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Invoices extends USER_Controller
{

    private $num_rows = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('InvoicesModel');
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $rowscount = $this->InvoicesModel->countInvoices($_GET);
        $data['invoices'] = $this->InvoicesModel->getInvoices($this->num_rows, $page);
        $data['inv_readable_types'] = $this->config->item('inv_readable_types');
        $data['linksPagination'] = pagination('user/invoices', $rowscount, $this->num_rows, 3);
        $this->render('invoices/index', $head, $data);
        $this->saveHistory('Go to invoices page');
    }

    public function deleteInvoice($id)
    {
        $this->InvoicesModel->deletePermanentlyInvoice($id);
        redirect(lang_url('user/invoices'));
    }

}
