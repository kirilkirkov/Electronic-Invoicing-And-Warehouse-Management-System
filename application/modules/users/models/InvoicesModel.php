<?php

class InvoicesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countInvoices()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('invoices.is_deleted', 0);
        return $this->db->count_all_results('invoices');
    }

    public function getInvoices($limit, $page)
    {
        $this->db->select('invoices_clients.client_name, invoices.inv_number, invoices.date_create, invoices.final_total, invoices.inv_type, invoices.status, invoices.inv_currency, invoices.id, invoices.payment_status');
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        $this->db->where('invoices.is_deleted', 0);
        $this->db->join('invoices_clients', 'invoices_clients.for_invoice = invoices.id');
        $result = $this->db->get('invoices', $limit, $page);
        return $result->result_array();
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

    public function setNewInvoiceStatus($post)
    {
        $this->db->where('id', $post['invId']);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('invoices', array('payment_status' => $post['newStatus']))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

}
