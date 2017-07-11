<?php

class HomeModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getFirms()
    {
        $this->db->select('firms_users.*, firms_translations.name, firms_translations.address, firms_translations.city, firms_translations.mol');
        $this->db->where('firms_users.is_deleted', 0);
        $this->db->where('firms_users.for_user', USER_ID);
        $this->db->where('firms_translations.is_default', 1);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        return $result->result_array();
    }

    public function checkBulstatIsFree($bulstat, $excludeMe = false)
    {
        if ($excludeMe !== true) {
            $this->db->where('id !=', $excludeMe);
        }
        $this->db->where('bulstat', $bulstat);
        $num = $this->db->count_all_results('firms_users');
        if ($num > 0) {
            return false;
        }
        return true;
    }

    public function setFirm($post)
    {
        $this->db->trans_begin();
        if (!$this->db->insert('firms_users', array(
                    'for_user' => USER_ID,
                    'bulstat' => htmlspecialchars(trim($post['firm_bulstat'])),
                    'is_default' => $post['is_default']
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
        $lastId = $this->db->insert_id();
        if (!$this->db->insert('firms_translations', array(
                    'for_firm' => $lastId,
                    'name' => htmlspecialchars(trim($post['firm_name'])),
                    'address' => htmlspecialchars(trim($post['firm_reg_address'])),
                    'city' => htmlspecialchars(trim($post['firm_city'])),
                    'mol' => htmlspecialchars(trim($post['firm_mol'])),
                    'trans_name' => $post['trans_name'] == null ? 'default' : htmlspecialchars(trim($post['trans_name'])),
                    'is_default' => 1
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
        return $lastId;
    }

    public function getDefaultCompany()
    {
        $this->db->select('firms_translations.*, firms_translations.id as translation_id, firms_users.*, firms_users.id as id');
        $this->db->limit(1);
        $this->db->where('for_user', USER_ID);
        $this->db->where('firms_translations.is_default', 1);
        $this->db->where('firms_users.is_default', 1);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        return $result->row_array();
    }

    public function checkCompanyIsValidForUser($companyId)
    {
        $this->db->select('firms_translations.*, firms_users.*, firms_users.id as firm_id');
        $this->db->limit(1);
        $this->db->where('for_user', USER_ID);
        $this->db->where('firms_users.id', $companyId);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        return $result->row_array();
    }

    public function getEmployeeAvailableFirms($id = 0)
    {
        $this->db->select('firms_access');
        $this->db->limit(1);
        $this->db->where('for_user', USER_ID);
        $this->db->where('id', $id > 0 ? $id : EMPLOYEE_ID);
        $result = $this->db->get('employees');
        $arr = $result->row_array();
        return unserialize($arr['firms_access']);
    }

    public function findResultsFromSearch($phrase)
    {
        $array = array();
        $this->db->select('inv_number, inv_type');
        $this->db->group_start();
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        $this->db->where('invoices.is_deleted', 0);
        $this->db->group_end();
        $this->db->group_start();
        $this->db->like('inv_number', $phrase);
        $this->db->or_like('client_name', $phrase);
        $this->db->group_end();
        $this->db->limit(5);
        $this->db->join('invoices_clients', 'invoices_clients.for_invoice = invoices.id');
        $result = $this->db->get('invoices');
        $rowsInvoices = $result->result_array();
        if (!empty($rowsInvoices)) {
            $array['invoices'] = $rowsInvoices;
        }

        $this->db->select('name, id');
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->like('name', $phrase);
        $this->db->limit(5);
        $result = $this->db->get('items');
        $rowsItems = $result->result_array();
        if (!empty($rowsItems)) {
            $array['items'] = $rowsItems;
        }

        $this->db->select('client_name, id');
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->like('client_name', $phrase);
        $this->db->limit(5);
        $result = $this->db->get('clients');
        $rowsClients = $result->result_array();
        if (!empty($rowsClients)) {
            $array['clients'] = $rowsClients;
        }

        return $array;
    }

}
