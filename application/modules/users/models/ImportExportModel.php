<?php

class ImportExportModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
     * wait for timestamps $from, $to
     */

    public function getInvoices($from = null, $to = null)
    {
        if ($from != null && $to != null) {
            $this->db->where('created >=', $from);
            $this->db->where('created <=', $to);
        }
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        $this->db->where('invoices.is_deleted', 0);
        $result = $this->db->get('invoices');
        $invoices = $result->result_array();
        if (empty($invoices)) {
            return $invoices;
        }
        foreach ($invoices as &$invoice) {
            $result = $this->db->where('for_invoice', $invoice['id'])->order_by('position', 'asc')->get('invoices_items');
            $items = $result->result_array();
            $invoice['items'] = $items;

            $result = $this->db->where('for_invoice', $invoice['id'])->get('invoices_clients');
            $client = $result->row_array();
            $invoice['client'] = $client;

            $result = $this->db->where('for_invoice', $invoice['id'])->get('invoices_firms');
            $firm = $result->row_array();
            $invoice['firm'] = $firm;
        }
        return $invoices;
    }

    /*
     * This method uses methods from NewInvoiceModel
     */

    public function setInvoicesFromImport($invoices)
    {
        $this->load->model('NewInvoiceModel');
        foreach ($invoices as $invoice) {
            /*
             * If no errors
             * Lets go import
             */
            if (empty($invoice['errors'])) {
                $this->NewInvoiceModel->setInvoice($invoice['inv']);
            }
        }
    }

}
