<?php

class PublicModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getOneLanguage($myLang)
    {
        $this->db->select('*');
        $this->db->where('abbr', $myLang);
        $result = $this->db->get('languages');
        return $result->row_array();
    }

    public function checkUserFreeEmail($email)
    {
        $this->db->where('enabled', 1);
        $this->db->where('email', $email);
        $num = $this->db->count_all_results('users');
        if ($num > 0) {
            return lang('registered_by_user');
        }
        return true;
    }

    public function registerUser($post)
    {
        $this->db->trans_begin();
        if (!$this->db->insert('users', array(
                    'email' => $post['email'],
                    'password' => password_hash($post['password'], PASSWORD_DEFAULT),
                    'ip_address' => $post['ip_address'],
                    'time_registered' => time()
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
        $user_id = $this->db->insert_id();
        $this->insertOptionsTables($user_id);
        $this->addFirstFreePlan($user_id);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    /*
     * Default system options for every user
     * they are named - value stores
     */

    private function insertOptionsTables($user_id)
    {
        $data = array(
            array(
                'for_user' => $user_id,
                '_key' => 'opt_invRoundTo',
                'value' => '2'
            ),
            array(
                'for_user' => $user_id,
                '_key' => 'opt_invCalculator',
                'value' => '1'
            ),
            array(
                'for_user' => $user_id,
                '_key' => 'opt_pagination',
                'value' => '20'
            ),
            array(
                'for_user' => $user_id,
                '_key' => 'opt_movementRoundTo',
                'value' => '2'
            ),
            array(
                'for_user' => $user_id,
                '_key' => 'opt_movementCalculator',
                'value' => '1'
            ),
            array(
                'for_user' => $user_id,
                '_key' => 'opt_negativeQuantities',
                'value' => '1'
            )
            ,
            array(
                'for_user' => $user_id,
                '_key' => 'opt_protocolCalculator',
                'value' => '1'
            )
            ,
            array(
                'for_user' => $user_id,
                '_key' => 'opt_protocolRoundTo',
                'value' => '1'
            ),
            array(
                'for_user' => $user_id,
                '_key' => 'opt_invTemplate',
                'value' => 'creative'
            )
        );
        if (!$this->db->insert_batch('value_store', $data)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    /*
     * Add first free plan when register
     */

    public function addFirstFreePlan($user_id)
    {
        if (!$this->db->insert('firms_plans', array(
                    'for_user' => $user_id,
                    'from_date' => time(),
                    'to_date' => strtotime("+1 month", time()),
                    'plan_type' => 'PRO',
                    'num_invoices' => 3000,
                    'num_firms' => 10,
                    'time' => time(),
                    'sponsored' => 1
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function getUserInfoFromEmail($email, $type)
    {
        $array = array();
        /*
         * if is logged employee
         * return data for user and for employee
         * else return data only for user
         */
        if ($type == 2) {
            $this->db->where('enabled', 1);
            $this->db->where('email', $email);
            $result = $this->db->get('employees');
            $array['employee'] = $result->row_array();

            $this->db->where('enabled', 1);
            $this->db->where('id', $array['employee']['for_user']);
            $result = $this->db->get('users');
            $array['user'] = $result->row_array();
        } else {
            $this->db->where('enabled', 1);
            $this->db->where('email', $email);
            $result = $this->db->get('users');
            $array['user'] = $result->row_array();
        }
        return $array;
    }

    /*
     * RETURN TYPES EXPLAIN
     * 1 is user
     * 2 is employee
     * 3 is both 
     */

    public function loginCheck($post)
    {
        $this->db->select('password');
        $this->db->where('enabled', 1);
        $this->db->where('email', $post['email']);
        $resultUsers = $this->db->get('users');
        $rows = $resultUsers->result_array();
        $numUsers = 0;
        foreach ($rows as $row) {
            if (password_verify($post['password'], $row['password'])) {
                $numUsers++;
            }
        }

        $this->db->select('password');
        $this->db->where('enabled', 1);
        $this->db->where('email', $post['email']);
        $resultEmployees = $this->db->get('employees');
        $rows = $resultEmployees->result_array();
        $numEmployees = 0;
        foreach ($rows as $row) {
            if (password_verify($post['password'], $row['password'])) {
                $numEmployees++;
            }
        }

        if ($numUsers > 0 && $numEmployees > 0) {
            return 3;
        }
        if ($numEmployees > 0 && $numUsers == 0) {
            return 2;
        }
        if ($numUsers > 0 && $numEmployees == 0) {
            return 1;
        }
        return false;
    }

    public function getValueStores()
    {
        $query = $this->db->query("SELECT _key, value FROM value_store WHERE for_user=" . USER_ID . "");
        $result = $query->result_array();
        if (empty($result)) {
            return null;
        }
        $arr = array();
        foreach ($result as $res) {
            $arr[$res['_key']] = $res['value'];
        }
        return $arr;
    }

    public function getOneValueStore($key, $userId)
    {
        $query = $this->db->query("SELECT value FROM value_store WHERE _key = '$key' AND for_user = " . $userId . "");
        $result = $query->row_array();
        if (empty($result)) {
            return null;
        }
        return $result['value'];
    }

    public function getInvoiceForAccept($userId, $uniqid)
    {
        $this->db->select('inv_type, inv_number');
        $this->db->where('for_user', $userId);
        $this->db->where('uniqid', $uniqid);
        $this->db->limit(1);
        $result = $this->db->get('invoices');
        return $result->row_array();
    }

    public function setInvoiceLog($invId, $action, $info = '')
    {
        $result = $this->db->query("INSERT DELAYED INTO invoices_logs (invoice_id, action, info, time) VALUES ($invId, '$action', '" . $this->db->escape_str($info) . "', " . time() . ")");
        if ($result != true) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

}
