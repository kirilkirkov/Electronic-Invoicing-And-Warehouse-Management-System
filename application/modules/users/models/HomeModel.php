<?php

class HomeModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getFirms($user_id)
    {
        $this->db->where('for_user', $user_id);
        $result = $this->db->get('firms_users');
        return $result->result_array();
    }

    public function checkBulstatIsFree($bulstat)
    {
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
            'for_user' => $post['for_user'],
            'bulstat' => $post['firm_bulstat'],
            'is_default' => $post['is_default']
        ));
        if ($result == false) {
            log_message('error', 'Cant insert to firms_users: ' . print_r($post, true));
        } else {
            $lastId = $this->db->insert_id();
            $result = $this->db->insert('firms_translations', array(
                'for_firm' => $lastId,
                'name' => $post['firm_name'],
                'address' => $post['firm_reg_address'],
                'city' => $post['firm_city'],
                'mol' => $post['firm_mol'],
                'is_default' => $post['is_default']
            ));
            if ($result == false) {
                log_message('error', 'Cant insert to firms_translations: ' . print_r($post, true));
            }
        }
    }

}
