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

}
