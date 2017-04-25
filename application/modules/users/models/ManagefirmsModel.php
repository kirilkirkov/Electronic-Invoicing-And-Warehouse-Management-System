<?php

class ManagefirmsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function deleteCompany($companyId)
    {
        $this->db->limit(1);
        $this->db->where('id', $companyId);
        $this->db->where('for_user', USER_ID);
        $result = $this->db->update('firms_users', array('is_deleted' => 1));
        if ($result == false) {
            log_message('error', 'Cant delete firm with id - ' . $companyId . ' and userid - ' . USER_ID);
        }
        return $result;
    }

    public function getCompanyInfo($companyId)
    {
        $array = array();

        $this->db->select('id, bulstat');
        $this->db->where('id', $companyId);
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('firms_users');
        $array['company'] = $result->row_array();

        $this->db->select('id, trans_name, is_default');
        $this->db->where('for_firm', $companyId);
        $result = $this->db->get('firms_translations');
        $array['translations'] = $result->result_array();

        return $array;
    }

    public function updateCompanyStaticInfo($bulstat, $companyId)
    {
        $this->db->where('id', $companyId);
        $this->db->where('for_user', USER_ID);
        $this->db->update('firms_users', array(
            'bulstat' => $bulstat
        ));
    }

    public function getTranslationInfo($translationId, $companyId)
    {
        $this->db->where('id', $translationId);
        $this->db->where('for_firm', $companyId);
        $result = $this->db->get('firms_translations');
        return $result->row_array();
    }

    public function getMyCompanyDefaultTranslation($companyId)
    {
        $this->db->limit(1);
        $this->db->where('for_firm', $companyId);
        $this->db->where('is_default', 1);
        $result = $this->db->get('firms_translations');
        return $result->row_array();
    }

    public function updateTranslation($post, $companyId)
    {
        $this->db->where('for_firm', $companyId);
        $this->db->where('id', $post['translation_id']);
        $result = $this->db->update('firms_translations', array(
            'trans_name' => $post['trans_name'],
            'name' => $post['firm_name'],
            'address' => $post['firm_reg_address'],
            'city' => $post['firm_city'],
            'mol' => $post['firm_mol'],
            'image' => $post['image']
        ));
        if ($result === false) {
            log_message('error', 'Cant save company translation for company - ' . $companyId . ': ' . print_r($post, true));
        }
        return $result;
    }

    public function setNewTranslation($post, $companyId)
    { 
        $result = $this->db->insert('firms_translations', array(
            'for_firm' => $companyId,
            'trans_name' => $post['trans_name'],
            'name' => $post['firm_name'],
            'address' => $post['firm_reg_address'],
            'city' => $post['firm_city'],
            'mol' => $post['firm_mol'],
            'image' => $post['image'],
            'is_default' => 0
        )); 
        if ($result === false) {
            log_message('error', 'Cant save new translation for company - ' . $companyId . ': ' . print_r($post, true));
        }
    }

}
