<?php

class SettingsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->getFirmsIdsForUser();
    }

    public function getMyFirmsDefaultCurrency()
    {
        $this->db->select('firms_users.id, default_currency, name');
        $this->db->where('for_user', USER_ID);
        $this->db->where('is_deleted', 0);
        $this->db->where('firms_translations.is_default', 1);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        return $result->result_array();
    }

    public function setNewDefaultCurrency($post)
    {
        $this->db->where('id', $post['forId']);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('firms_users', array('default_currency' => $post['newDefault']))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function deleteDefaultCurrency($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('firms_users', array('default_currency' => ''))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setNewCurrency($post)
    {
        if (!$this->db->insert('users_currencies', array(
                    'for_user' => USER_ID,
                    'name' => htmlspecialchars($post['currencyName']),
                    'value' => htmlspecialchars($post['currencyValue']
            )))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyCurrencies()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('users_currencies');
        return $result->result_array();
    }

    public function deleteMyCurrency($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('users_currencies')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyQuantityTypes()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('users_quantity_types');
        return $result->result_array();
    }

    public function deleteCustomQuantityType($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('users_quantity_types')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyPaymentMethods()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('users_payment_methods');
        return $result->result_array();
    }

    public function deleteCustomPaymentMethod($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('users_payment_methods')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyNoVatReasons()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('user_no_vat_reasons');
        return $result->result_array();
    }

    public function deleteMyNoVatReason($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('user_no_vat_reasons')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setValueStore($key, $value)
    {
        $this->db->where('_key', $key);
        $query = $this->db->get('value_store');
        if ($query->num_rows() > 0) {

            $this->db->where('_key', $key);
            $this->db->where('for_user', USER_ID);
            $this->db->update('value_store', array('value' => $value));
        } else {
            $this->db->insert('value_store', array('for_user' => USER_ID, 'value' => $value, '_key' => $key));
        }
    }

    public function getValueStores($key)
    {
        $query = $this->db->query("SELECT value FROM value_store WHERE _key = '$key' AND for_user = " . USER_ID . "");
        $result = $query->row_array();
        if (empty($result)) {
            return null;
        }
        return $result['value'];
    }

    public function countEmployees()
    {
        $this->db->where('for_user', USER_ID);
        return $this->db->count_all_results('employees');
    }

    public function getEmployees($limit, $page)
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('employees', $limit, $page);
        return $result->result_array();
    }

    public function setEmployee($post)
    {
        $insertArray = array(
            'for_user' => USER_ID,
            'name' => htmlspecialchars(trim($post['name'])),
            'email' => htmlspecialchars(trim($post['email'])),
            'phone' => htmlspecialchars(trim($post['phone'])),
            'schiffer' => htmlspecialchars(trim($post['schiffer'])),
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'time_added' => time()
        );
        if (isset($post['firms'])) {
            $insertArray['firms_access'] = serialize($post['firms']);
        }
        if ($post['editId'] > 0) {
            if (mb_strlen(trim($post['password'])) == 0) {
                unset($insertArray['password']);
            }
            unset($insertArray['time_added']);
            if (!$this->db->where('id', $post['editId'])->update('employees', $insertArray)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            // if employee, add new employee he cant add access firms 
            // and we add this firm only to new employee
            if (!isset($insertArray['firms_access']) && defined('EMPLOYEE_ID')) {
                $insertArray['firms_access'] = serialize(array(SELECTED_COMPANY_ID));
            }
            if (!$this->db->insert('employees', $insertArray)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            return $this->db->insert_id();
        }
    }

    public function getFirmsIdsForUser()
    {
        $this->db->select('id');
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('firms_users');
        $str = '';
        foreach ($result->result_array() as $fr) {
            $str .= ',' . $fr['id'];
        }
        return explode(',', ltrim($str, ','));
    }

    public function getEmployeeInfo($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('employees');
        return $result->row_array();
    }

    public function checkEmployeeFreeEmail($email, $editId)
    {
        if ($editId > 0) {
            $this->db->where('employees.id !=', $editId);
        }
        $this->db->where('for_user', USER_ID);
        $this->db->where('email', $email);
        $num1 = $this->db->count_all_results('employees');

        $this->db->where('id', USER_ID);
        $this->db->where('email', $email);
        $num2 = $this->db->count_all_results('users');
        $num = $num1 + $num2;
        if ($num > 0) {
            return false;
        }
        return true;
    }

    public function deleteEmployee($id)
    {
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('employees')) {
            log_message('error', print_r($this->db->error(), true));
        }
        $this->db->where('for_employee', $id);
        if (!$this->db->delete('employees_permissions')) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function setNewEmployeePermissions($employeeId, $defaultPermissions)
    {
        $insertArray = array();
        foreach ($defaultPermissions as $key => $value) {
            $insertArray[] = array(
                'for_employee' => $employeeId,
                'perm' => $key,
                'role' => $value
            );
        }
        if (!$this->db->insert_batch('employees_permissions', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getPermissions()
    {
        $this->db->where('for_employee', EMPLOYEE_ID);
        $result = $this->db->get('employees_permissions');
        return $result->result_array();
    }

    public function getEmployeePermissions($id)
    {
        $array = array();
        $this->db->select('perm, role');
        $this->db->where('for_employee', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->join('employees', 'employees.id = employees_permissions.for_employee');
        $result = $this->db->get('employees_permissions');
        $arr = $result->result_array();
        foreach ($arr as $ar) {
            $array[$ar['perm']] = $ar['role'];
        }
        return $array;
    }

    public function updateEmployeePermissions($newPermissions, $employeeId)
    {
        foreach ($newPermissions as $key => $val) {
            $this->db->where('for_employee', $employeeId);
            $this->db->where('perm', $key);
            if (!$this->db->update('employees_permissions', array('role' => $val))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function getAdminInfo()
    {
        $this->db->where('id', USER_ID);
        $result = $this->db->get('users');
        return $result->row_array();
    }

    public function checkRegisteredUserFreeEmail($email)
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('email', $email);
        $num1 = $this->db->count_all_results('employees');

        $this->db->where('email', $email);
        $this->db->where('id !=', USER_ID);
        $num2 = $this->db->count_all_results('users');
        $num = $num1 + $num2;
        if ($num > 0) {
            return false;
        }
        return true;
    }

    public function updateUserAdminInfo($post)
    {
        unset($post['id']);
        if (mb_strlen(trim($post['password'])) == 0) {
            unset($post['password']);
        }
        $this->db->where('id', USER_ID);
        if (!$this->db->update('users', $post)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        } else {
            $_SESSION['user_login']['email'] = $post['email'];
        }
    }

    public function setNewStore($storeName)
    {
        if (!$this->db->insert('stores', array(
                    'name' => $storeName,
                    'for_user' => USER_ID,
                    'for_company' => SELECTED_COMPANY_ID,
                    'created' => time()
                ))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function checkStoreNameIsFree($storeName)
    {
        $this->db->where('id', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('name', $storeName);
        $num = $this->db->count_all_results('stores');
        if ($num > 0) {
            return false;
        }
        return true;
    }

    public function deleteStore($id)
    {
        $this->db->where('id', $id);
        $this->db->where('id', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        if (!$this->db->update('stores', array('is_deleted' => 1))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

}
