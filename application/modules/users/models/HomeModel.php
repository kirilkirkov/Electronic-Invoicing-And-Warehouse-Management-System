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
        if (!$this->db->insert('firms_users', array(
                    'for_user' => USER_ID,
                    'bulstat' => $post['firm_bulstat'],
                    'is_default' => $post['is_default']
                ))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
        $lastId = $this->db->insert_id();
        if (!$this->db->insert('firms_translations', array(
                    'for_firm' => $lastId,
                    'name' => $post['firm_name'],
                    'address' => $post['firm_reg_address'],
                    'city' => $post['firm_city'],
                    'mol' => $post['firm_mol'],
                    'is_default' => 1
                ))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
        return $lastId;
    }

    public function getDefaultCompany()
    {
        $this->db->select('firms_users.id, firms_translations.name');
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
        $this->db->select('firms_users.id, firms_translations.name');
        $this->db->limit(1);
        $this->db->where('for_user', USER_ID);
        $this->db->where('firms_users.id', $companyId);
        $this->db->where('firms_translations.is_default', 1);
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

}
