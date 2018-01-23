<?php

class ClientsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countClients($get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setClientsSearchFilter($get);
        }
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        return $this->db->count_all_results('clients');
    }

    public function getClients($limit, $page, $get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setClientsSearchFilter($get);
        }
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('clients', $limit, $page);
        return $result->result_array();
    }

    private function setClientsSearchFilter($get)
    {
        if (isset($get['client_name']) && $get['client_name'] != '') {
            $this->db->like('client_name', $get['client_name']);
        }
        if (isset($get['client_bulstat']) && $get['client_bulstat'] != '') {
            $this->db->like('client_bulstat', $get['client_bulstat']);
        }
    }

    public function getClientInfo($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('clients');
        return $result->row_array();
    }

    public function deleteClient($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        if (!$this->db->delete('clients')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function multipleDeleteClients($ids)
    {
        if ($ids != null && is_array($ids)) {
            $this->db->where_in('id', $ids);
            $this->db->where('for_user', USER_ID);
            $this->db->where('for_company', SELECTED_COMPANY_ID);
            if (!$this->db->delete('clients')) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

}
