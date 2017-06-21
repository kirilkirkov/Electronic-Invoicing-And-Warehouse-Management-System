<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ImportExport extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ImportExportModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $this->postChecker();
        $thisYear = thisyeardates();
        $data['from_date'] = $thisYear['from'];
        $data['to_date'] = $thisYear['to'];
        $this->render('import_export/index', $head, $data);
        $this->saveHistory('Go to import export page');
    }

    private function postChecker()
    {
        if (isset($_POST['exportType'])) {
            $this->doExport();
        }
    }

    /*
     * All exporters returns file and headers
     * To be open from browser
     */

    private function doExport()
    {
        // check if we export for date range or all
        $from = strtotime($_POST['from_date']);
        $to = strtotime($_POST['to_date']);
        if ($from == false || $to == false) { // prevent from wrong information exact date
            $from = null;
            $to = null;
        }
        if (isset($_POST['export_all'])) {
            $from = null;
            $to = null;
        }

        // get invoices
        $resultInvoices = $this->ImportExportModel->getInvoices($from, $to);
        // if no invoices.. return to page with message
        if (empty($resultInvoices)) {
            $this->session->set_flashdata('resultAction', lang('no_invoices_result_export'));
            redirect(lang_url('user/import-export'));
        }

        /*
         * Lets call the selected exporter
         */
        $invReadableTypes = $this->config->item('inv_readable_types');
        $isSelected = false;
        if ($_POST['exportType'] == 'xml') {
            $this->load->library('exporters/XmlExport');
            $this->xmlexport->setDates($from, $to);
            $this->xmlexport->setInvTypes($invReadableTypes);
            $this->xmlexport->getXmlFileFromInvoicesArray($resultInvoices);
            $isSelected = true;
        }
        if ($_POST['exportType'] == 'excel') {
            $this->load->library('exporters/ExcelExport');
            $this->excelexport->setDates($from, $to);
            $this->excelexport->setInvTypes($invReadableTypes);
            $this->excelexport->getExcelFileFromInovoicesArray($resultInvoices);
            $isSelected = true;
        }
        if ($isSelected == false) {
            $this->session->set_flashdata('resultAction', lang('selected_invalid_exporter'));
            redirect(lang_url('user/import-export'));
        }
    }

}
