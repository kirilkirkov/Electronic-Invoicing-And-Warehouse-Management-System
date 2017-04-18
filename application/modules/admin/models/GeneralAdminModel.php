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
            $this->db->where('id', $res_arr['id']);
            $this->db->update('admin_users', array('last_login' => time()));
        }
        return $res_arr;
    }

    public function setHistory($activity, $username, $id)
    {
        $this->db->insert('history', array('activity' => $activity, 'user_id' => $id, 'username' => $username, 'time' => time()));
    }

    public function setValueStore($post)
    {
        $this->db->where('v_key', $post['v_key']);
        $this->db->update('value_store', array('value' => $post['value']));
    }

}
