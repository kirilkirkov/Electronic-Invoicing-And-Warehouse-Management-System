<?php

class InvoicesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countInvoices()
    {
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        return $this->db->count_all_results('invoices');
    }

    public function getInvoices($limit, $page)
    {
        $this->db->select('invoices_clients.client_name, invoices.inv_number, invoices.date_create, invoices.final_total, invoices.is_draft, invoices.inv_type, invoices.status, invoices.inv_currency');
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        $this->db->join('invoices_clients', 'invoices_clients.for_invoice = invoices.id');
        $result = $this->db->get('invoices', $limit, $page);
        return $result->result_array();
    }

}
