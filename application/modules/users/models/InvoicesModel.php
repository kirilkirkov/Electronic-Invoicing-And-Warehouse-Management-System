<?php

class InvoicesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countInvoices($get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setInvoicesSearchFilter($get);
        }
        $this->db->select('COUNT(invoices.id)');
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        $this->db->where('invoices.is_deleted', 0);
        $this->db->join('invoices_clients', 'invoices_clients.for_invoice = invoices.id');
        return $this->db->count_all_results('invoices');
    }

    public function sumOfAmounts($get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setInvoicesSearchFilter($get);
        }
        $this->db->select('SUM(invoices.final_total) as sumAmount');
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        $this->db->where('invoices.is_deleted', 0);
        $this->db->join('invoices_clients', 'invoices_clients.for_invoice = invoices.id');
        $result = $this->db->get('invoices');
        $row = $result->row_array();
        return $row['sumAmount'];
    }

    public function getInvoices($limit, $page, $get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setInvoicesSearchFilter($get);
        }
        $this->db->select('invoices_clients.client_name, invoices.inv_number, invoices.date_create, invoices.final_total, invoices.inv_type, invoices.status, invoices.inv_currency, invoices.id, invoices.payment_status');
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        $this->db->where('invoices.is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->join('invoices_clients', 'invoices_clients.for_invoice = invoices.id');
        $result = $this->db->get('invoices', $limit, $page);
        return $result->result_array();
    }

    private function setInvoicesSearchFilter($get)
    {
        if (isset($get['inv_number']) && trim($get['inv_number']) != '') {
            $this->db->like('inv_number', (int) $get['inv_number']);
        }
        if (isset($get['inv_client']) && trim($get['inv_client']) != '') {
            $this->db->like('invoices_clients.client_name', trim($get['inv_client']));
        }
        if (isset($get['inv_item']) && trim($get['inv_item']) != '') {
            $this->db->join('invoices_items', 'invoices_items.for_invoice = invoices.id');
            $this->db->like('invoices_items.name', trim($get['inv_item']));
            $this->db->distinct();
        }
        if (isset($get['amount_from']) && $get['amount_from'] != '') {
            $this->db->where('final_total >=', (float) $get['amount_from']);
        }
        if (isset($get['amount_to']) && $get['amount_to'] != '') {
            $this->db->where('final_total >=', (float) $get['amount_to']);
        }
        if (isset($get['create_from']) && trim($get['create_from']) != '') {
            $from = strtotime($get['create_from']);
            if ($from != false) {
                $this->db->where('created >=', $from);
            }
        }
        if (isset($get['create_to']) && trim($get['create_to']) != '') {
            $to = strtotime($get['create_to']);
            if ($to != false) {
                $this->db->where('created <=', $to);
            }
        }
        if (isset($get['inv_payment_type']) && trim($get['inv_payment_type']) != '') {
            $this->db->where('payment_method', trim($get['inv_payment_type']));
        }
        if (isset($get['inv_type']) && $get['inv_type'] != '') {
            $this->db->where_in('inv_type', $get['inv_type']);
        }
        if (isset($get['inv_payment']) && $get['inv_payment'] != '') {
            $this->db->where_in('payment_status', $get['inv_payment']);
        }
        if (isset($get['inv_status']) && $get['inv_status'] != '') {
            $this->db->where_in('status', $get['inv_status']);
        }
    }

    public function deleteInvoice($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        if (!$this->db->update('invoices', array('is_deleted' => 1))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function multipleDeleteInvoices($ids)
    {
        if ($ids != null && is_array($ids)) {
            $this->db->where_in('id', $ids);
            $this->db->where('for_user', USER_ID);
            $this->db->where('for_company', SELECTED_COMPANY_ID);
            if (!$this->db->update('invoices', array('is_deleted' => 1))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function multipleStatusCanceledInvoices($ids, $doCanceled)
    {
        if ($ids != null && is_array($ids)) {
            $this->db->where_in('id', $ids);
            $this->db->where('for_user', USER_ID);
            $this->db->where('for_company', SELECTED_COMPANY_ID);
            if ($doCanceled == true) {
                $status = 'canceled';
            } else {
                $status = 'issued';
            }
            if (!$this->db->update('invoices', array('status' => $status))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function updateInvoicePaymentStatus($invoiceId, $toStatus)
    {
        $this->db->where('id', $invoiceId);
        if (!$this->db->update('invoices', array('payment_status' => $toStatus))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

}
