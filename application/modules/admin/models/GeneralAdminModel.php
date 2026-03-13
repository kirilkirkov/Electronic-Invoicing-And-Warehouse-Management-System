<?php

class GeneralAdminModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function loginCheck($values)
    {
        $this->db->where('username', $values['username']);
        $result = $this->db->get('admin_users');
        $res_arr = $result->row_array();
        if (empty($res_arr)) {
            return null;
        }
        $storedPassword = $res_arr['password'];
        $isValid = false;
        if (password_verify($values['password'], $storedPassword)) {
            $isValid = true;
        } elseif (strlen($storedPassword) === 32 && $storedPassword === md5($values['password'])) {
            // Legacy MD5 — upgrade to bcrypt on successful login
            $isValid = true;
            $newHash = password_hash($values['password'], PASSWORD_DEFAULT);
            $this->db->where('id', $res_arr['id'])->update('admin_users', array('password' => $newHash));
        }
        if ($isValid) {
            if (!$this->db->where('id', $res_arr['id'])->update('admin_users', array('last_login' => time()))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            return $res_arr;
        }
        return null;
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
