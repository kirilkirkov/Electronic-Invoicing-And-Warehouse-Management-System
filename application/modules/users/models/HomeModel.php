<?php

class HomeModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getFirms($user_id)
    {
        $this->db->select('firms_users.*, firms_translations.name, firms_translations.address, firms_translations.city, firms_translations.mol');
        $this->db->where('firms_users.is_deleted', 0);
        $this->db->where('firms_users.for_user', $user_id);
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
        $result = $this->db->insert('firms_users', array(
            'for_user' => USER_ID,
            'bulstat' => $post['firm_bulstat'],
            'is_default' => $post['is_default']
        ));
        if ($result === false) {
            log_message('error', 'Cant insert to firms_users: ' . print_r($post, true));
        } else {
            $lastId = $this->db->insert_id();
            $result = $this->db->insert('firms_translations', array(
                'for_firm' => $lastId,
                'name' => $post['firm_name'],
                'address' => $post['firm_reg_address'],
                'city' => $post['firm_city'],
                'mol' => $post['firm_mol'],
                'is_default' => 1
            ));
            if ($result === false) {
                log_message('error', 'Cant insert to firms_translations: ' . print_r($post, true));
            }
        }
        return $lastId;
    }

}
