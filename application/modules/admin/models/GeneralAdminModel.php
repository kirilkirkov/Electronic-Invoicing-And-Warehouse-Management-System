<?php

class GeneralAdminModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function loginCheck($values)
    {
        $arr = array(
            'username' => $values['username'],
            'password' => md5($values['password']),
        );
        $this->db->where($arr);
        $result = $this->db->get('admin_users');
        $res_arr = $result->row_array();
        if ($res_arr != null) {
            if (!$this->db->where('id', $res_arr['id'])->update('admin_users', array('last_login' => time()))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
        return $res_arr;
    }

    public function setHistory($activity, $username, $id)
    {
        if (!$this->db->insert('history', array('activity' => $activity, 'user_id' => $id, 'username' => $username, 'time' => time()))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setValueStore($post)
    {
        if (!$this->db->where('v_key', $post['v_key'])->update('value_store', array('value' => $post['value']))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

}
