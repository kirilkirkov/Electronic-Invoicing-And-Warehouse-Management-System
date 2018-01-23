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
        $this->load->model(array('ReportsModel', 'NewInvoiceModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_reports');
        if (!isset($_GET['from_date']) && !isset($_GET['to_date'])) {
            $thisYear = thisyeardates();
            $_GET['from_date'] = $thisYear['from'];
            $_GET['to_date'] = $thisYear['to'];
        }
        $showDraft = isset($_GET['show_drafts']) && $_GET['show_drafts'] == 'true' ? true : false;
        $data['inv_readable_types'] = $this->config->item('inv_readable_types');
        $data['issuedInvoices'] = $this->ReportsModel->getIssuedInvoices(strtotime($_GET['from_date']), strtotime($_GET['to_date']), $showDraft, isset($_GET['payment_status'])?$_GET['payment_status']:null);
        $data['issuedInvoicesByMonth'] = $this->ReportsModel->getIssuedInvoicesByMonth($_GET['from_date'], $_GET['to_date'], $showDraft, isset($_GET['payment_status'])?$_GET['payment_status']:null);
        $data['topClients'] = $this->ReportsModel->getTopClients($_GET['from_date'], $_GET['to_date'], $showDraft, isset($_GET['payment_status'])?$_GET['payment_status']:null);
        $data['betweenDates'] = lang('from_date') . $_GET['from_date'] . ' - ' . lang('to_date') . $_GET['to_date'];
        $data['firmCurrency'] = $this->NewInvoiceModel->getFirmDefaultCurrency();
        $this->render('reports/index', $head, $data);
        $this->saveHistory('Go to items page');
    }

}
