<?php

class NewInvoiceModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCurrencies()
    {
        $this->db->select('name, value');
        $result = $this->db->get('currencies');
        return $result->result_array();
    }

}
