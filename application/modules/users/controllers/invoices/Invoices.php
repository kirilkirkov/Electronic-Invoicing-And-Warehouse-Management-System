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

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('InvoicesModel', 'SettingsModel'));
        $paginationNumRows = $this->SettingsModel->getValueStores('opt_pagination');
        $this->num_rows = $paginationNumRows;
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $this->postChecker();
        $rowscount = $this->InvoicesModel->countInvoices($_GET);
        $data['invoices'] = $this->InvoicesModel->getInvoices($this->num_rows, $page);
        $data['inv_readable_types'] = $this->config->item('inv_readable_types');
        $data['linksPagination'] = pagination('user/invoices', $rowscount, $this->num_rows, 3);
        $this->render('invoices/index', $head, $data);
        $this->saveHistory('Go to invoices page');
    }

    private function postChecker()
    {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                $this->deleteSelectedInvoices($_POST['ids']);
            }
        }
    }

    private function deleteSelectedInvoices($ids)
    {
        $this->InvoicesModel->multipleDeleteInvoices($ids);
        redirect(lang_url('user/invoices'));
    }

    public function deleteInvoice($id)
    {
        $this->InvoicesModel->deletePermanentlyInvoice($id);
        redirect(lang_url('user/invoices'));
    }

}
