<?php

class SettingsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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
        $result = $this->db->update('firms_users', array('default_currency' => $post['newDefault']));
        return $result;
    }

    public function deleteDefaultCurrency($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $result = $this->db->update('firms_users', array('default_currency' => ''));
        return $result;
    }

    public function setNewCurrency($post)
    {
        $this->db->insert('users_currencies', array('for_user' => USER_ID, 'name' => $post['currencyName'], 'value' => $post['currencyValue']));
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
        $result = $this->db->delete('users_currencies');
        return $result;
    }

}
