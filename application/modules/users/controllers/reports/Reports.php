<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reports extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ReportsModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        if (!isset($_GET['from_date']) && !isset($_GET['to_date'])) {
            $thisYear = thisyeardates();
            $_GET['from_date'] = $thisYear['from'];
            $_GET['to_date'] = $thisYear['to'];
        }
        $data['inv_readable_types'] = $this->config->item('inv_readable_types');
        $data['issuedInvoices'] = $this->ReportsModel->getIssuedInvoices(strtotime($_GET['from_date']), strtotime($_GET['to_date']));
        $data['issuedInvoicesByMonth'] = $this->ReportsModel->getIssuedInvoicesByMonth($_GET['from_date'], $_GET['to_date']);
        $data['betweenDates'] = lang('from_date') . $_GET['from_date'] . ' - ' . lang('to_date') . $_GET['to_date'];
        $this->render('reports/index', $head, $data);
        $this->saveHistory('Go to items page');
    }

}
