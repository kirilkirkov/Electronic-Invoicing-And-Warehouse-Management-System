<?php

class NewInvoiceModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCurrencies()
    {
        $result = $this->db->query('SELECT name, value FROM currencies UNION ALL SELECT name, value FROM users_currencies WHERE users_currencies.for_user = ' . $this->db->escape(USER_ID));
        return $result->result_array();
    }

    public function getFirmDefaultCurrency()
    {
        $this->db->select('default_currency');
        $this->db->where('id', SELECTED_COMPANY_ID);
        $result = $this->db->get('firms_users');
        $ar = $result->row_array();
        return $ar['default_currency'];
    }

    public function getAllQuantityTypes()
    {
        $result = $this->db->query('SELECT name FROM quantity_types UNION ALL SELECT name FROM users_quantity_types WHERE users_quantity_types.for_user = ' . $this->db->escape(USER_ID));
        return $result->result_array();
    }

    public function setNewCustomQuantityType($newQuantityType)
    {
        if (!$this->db->insert('users_quantity_types', array('name' => $newQuantityType, 'for_user' => USER_ID))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getPaymentMethods()
    {
        $result = $this->db->query('SELECT name FROM payment_methods UNION ALL SELECT name FROM users_payment_methods WHERE users_payment_methods.for_user = ' . $this->db->escape(USER_ID));
        return $result->result_array();
    }

    public function setNewCustomPaymentMethod($newPaymentMethod)
    {
        if (!$this->db->insert('users_payment_methods', array('name' => $newPaymentMethod, 'for_user' => USER_ID))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setNewVatReason($newVatReason)
    {
        if (!$this->db->insert('user_no_vat_reasons', array('reason' => $newVatReason, 'for_user' => USER_ID))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function updateInvoicesRoundTo($roundTo)
    {
        $this->db->limit(1);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('users_invoices_options', array('opt_inv_roundTo' => $roundTo))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setNewInvoiceLanguage($post)
    {
        unset($post['addNewTranslation']);
        $post['for_user'] = USER_ID;
        if (!$this->db->insert('invoices_languages', $post)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyInvoiceLanguages()
    {
        $this->db->select('id, language_name');
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('invoices_languages');
        return $result->result_array();
    }

}
