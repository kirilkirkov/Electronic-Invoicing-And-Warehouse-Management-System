<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ExcelExport class 
 * For export invoices to excel file
 */

class ExcelExport
{

    private $from;
    private $to;
    private $invReadableTypes;
    private $fsize;
    private $CI;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->setInvTypes($this->CI->config->item('inv_readable_types'));
    }

    // wait for invoices array
    public function getExcelFileFromInovoicesArray($invoices)
    {
        $this->generateExcel($invoices);
    }

    public function setDates($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    private function setInvTypes($invReadableTypes)
    {
        $this->invReadableTypes = $invReadableTypes;
    }

    private function generateExcel($invoices)
    {
        ob_clean();

        require 'application/libraries/PHPExcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Invoice Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Invoice Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Client Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Client Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Client Bulstat/PIN');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Client Vat Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Client Accountable person');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Date of issue');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Date Tax Event');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Invoice Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Discount');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Tax Base');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Vat Sum');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Total');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Currency');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Payment Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Payment status');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Compiled');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Sended');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Received');
        $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Date of receive');
        $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'Return reason');
        $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'Date created');
        $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'Vat Reason');
        $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'Remarks');
        $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'Maturity date');
        foreach (range('A', 'Z') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);

        $i = 2;
        foreach ($invoices as $invoice) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $i, $invoice['inv_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $i, $this->invReadableTypes[$invoice['inv_type']]);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $i, $invoice['client']['client_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $i, $invoice['client']['client_address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $i, $invoice['client']['is_to_person'] != 1 ? $invoice['client']['client_bulstat'] : $invoice['client']['client_ident_num']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $i, $invoice['client']['vat_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $i, $invoice['client']['accountable_person']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $i, date('d.m.Y', $invoice['date_create']));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $i, date('d.m.Y', $invoice['date_tax_event']));
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $i, $invoice['invoice_amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $i, $invoice['discount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $i, $invoice['tax_base']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $i, $invoice['vat_sum']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $i, $invoice['final_total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $i, $invoice['inv_currency']);
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $i, $invoice['payment_method']);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $i, $invoice['payment_status']);
            $objPHPExcel->getActiveSheet()->SetCellValue('R' . $i, $invoice['composed']);
            $objPHPExcel->getActiveSheet()->SetCellValue('S' . $i, $invoice['status'] == 'sended' || $invoice['status'] == 'received' ? 1 : 0);
            $objPHPExcel->getActiveSheet()->SetCellValue('T' . $i, $invoice['status'] == 'received' ? 1 : 0);
            $objPHPExcel->getActiveSheet()->SetCellValue('U' . $i, $invoice['date_received'] != 0 ? date('d.m.Y', $invoice['date_received']) : '');
            $objPHPExcel->getActiveSheet()->SetCellValue('V' . $i, $invoice['return_reason']);
            $objPHPExcel->getActiveSheet()->SetCellValue('W' . $i, date('d.m.Y', $invoice['created']));
            $objPHPExcel->getActiveSheet()->SetCellValue('X' . $i, html_entity_decode($invoice['no_vat_reason']));
            $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $i, html_entity_decode($invoice['remarks']));
            $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $i, $invoice['have_maturity_date'] == 1 ? date('d.m.Y', $invoice['maturity_date']) : '');
            $i++;
        }

        $exW = new PHPExcel_Writer_Excel5($objPHPExcel);
        $tmpname = tempnam("/tmp", "EXCEL_");
        if ($tmpname === false) {
            log_message('error', 'Was not able to generate a temporary file for excel export in system /tmp for user - ' . print_r($_SESSION['user_login'], true));
        }
        $exW->save($tmpname);
        $this->fsize = filesize($tmpname);

        $this->getXmlHeaders();

        readfile($tmpname);
        unlink($tmpname);
        exit;
    }

    private function getXmlHeaders()
    {
        $filename = 'export_invoices.xls';
        if ($this->from != null && $this->to != null) {
            $this->from = date('d.m.Y', $this->from);
            $this->to = date('d.m.Y', $this->to);
            $filename = 'export_invoices_from_' . $this->from . '_to_' . $this->to . '.xls';
        }
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . $this->fsize);
    }

}
