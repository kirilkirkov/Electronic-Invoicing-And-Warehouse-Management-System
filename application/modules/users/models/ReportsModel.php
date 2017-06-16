<?php

class ReportsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getIssuedInvoices($from = null, $to = null)
    {
        $between = '';
        if ($from != null && $to != null) {
            $between = ' AND created >= ' . $from . ' AND created <= ' . $to;
        }
        $query = $this->db->query('SELECT SUM(IF(inv_type="tax_inv",1,0)) as tax_inv, SUM(IF(inv_type="prof",1,0)) as prof, SUM(IF(inv_type="debit",1,0)) as debit, SUM(IF(inv_type="credit",1,0)) as credit FROM invoices WHERE for_user = ' . USER_ID . ' AND for_company = ' . SELECTED_COMPANY_ID . $between);
        $result = $query->row_array();
        if ($result['tax_inv'] === null && $result['prof'] === null && $result['debit'] === null && $result['credit'] === null) {
            return array();
        }
        return $result;
    }

    public function getIssuedInvoicesByMonth($from, $to)
    {
        $months = array();
        $invMonths = array();
        if (!(bool) strtotime($from) || !(bool) strtotime($to)) {
            return $invMonths;
        }
        $start = new DateTime($from);
        $start->modify('first day of this month');
        $end = new DateTime($to);
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);

        // get all months.years between selected dates
        foreach ($period as $dt) {
            $months[$dt->format("M Y")] = 0;
        }

        // give to all types of invoices all selected months.years and set issued to 0
        $invReadableTypes = $this->config->item('inv_readable_types');
        foreach ($invReadableTypes as $inType) {
            $invMonths[$inType] = $months;
        }

        // get from database all invoices group by type and date created (month.year)
        $from = strtotime($from);
        $to = strtotime($to);
        $between = ' AND created >= ' . $from . ' AND created <= ' . $to;
        $query = $this->db->query('SELECT COUNT(id) AS num_created, inv_type, DATE_FORMAT(FROM_UNIXTIME(created), "%b %Y") AS date_created FROM invoices WHERE for_user = ' . USER_ID . ' AND for_company = ' . SELECTED_COMPANY_ID . $between . ' GROUP BY date_created, inv_type');
        $result = $query->result_array();

        // add to months of each type of invoice - num issued
        foreach ($result as $invoices) {
            if (array_key_exists($invReadableTypes[$invoices['inv_type']], $invMonths)) {
                if (array_key_exists($invoices['date_created'], $invMonths[$invReadableTypes[$invoices['inv_type']]])) {
                    $invMonths[$invReadableTypes[$invoices['inv_type']]][$invoices['date_created']] = (int) $invoices['num_created'];
                }
            }
        }
        return $invMonths;
    }

}
