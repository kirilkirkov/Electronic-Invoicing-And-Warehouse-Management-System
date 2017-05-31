<?php

class ClientsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countClients()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        return $this->db->count_all_results('clients');
    }

    public function getClients($limit, $page)
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('clients', $limit, $page);
        return $result->result_array();
    }

    public function getClientInfo($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('clients');
        return $result->row_array();
    }

}
