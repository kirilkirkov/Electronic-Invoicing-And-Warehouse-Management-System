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
        return $this->db->count_all_results('invoices');
    }

    public function getInvoices($limit, $page)
    {
        $this->db->select('invoices_clients.client_name, invoices.inv_number, invoices.date_create, invoices.final_total, invoices.is_draft, invoices.inv_type, invoices.status, invoices.inv_currency, invoices.id');
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        $this->db->join('invoices_clients', 'invoices_clients.for_invoice = invoices.id');
        $result = $this->db->get('invoices', $limit, $page);
        return $result->result_array();
    }

    public function deletePermanentlyInvoice($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        if (!$this->db->delete('invoices')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }

        $this->db->where('for_invoice', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        if (!$this->db->delete('invoices_clients')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }

        $this->db->where('for_invoice', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('invoices_firms')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }

        $this->db->where('for_invoice', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        if (!$this->db->delete('invoices_items')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }

        $this->db->where('for_invoice', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('invoices_translations')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function multipleDeleteInvoices($ids)
    {
        if ($ids != null && is_array($ids)) {
            $this->db->where_in('id', $id);
            $this->db->where('for_user', USER_ID);
            $this->db->where('for_company', SELECTED_COMPANY_ID);
            if (!$this->db->delete('invoices')) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }

            $this->db->where_in('for_invoice', $id);
            $this->db->where('for_user', USER_ID);
            $this->db->where('for_company', SELECTED_COMPANY_ID);
            if (!$this->db->delete('invoices_clients')) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }

            $this->db->where_in('for_invoice', $id);
            $this->db->where('for_user', USER_ID);
            if (!$this->db->delete('invoices_firms')) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }

            $this->db->where_in('for_invoice', $id);
            $this->db->where('for_user', USER_ID);
            $this->db->where('for_company', SELECTED_COMPANY_ID);
            if (!$this->db->delete('invoices_items')) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }

            $this->db->where_in('for_invoice', $id);
            $this->db->where('for_user', USER_ID);
            if (!$this->db->delete('invoices_translations')) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

}
