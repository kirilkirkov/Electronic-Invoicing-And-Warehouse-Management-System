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
        if (!$this->db->update('firms_users', array('is_deleted' => 1))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
        $this->checkThatWeHaveDefaultCompany($companyId);
        return $result;
    }

    /*
     * If we dont have default company after delete
     * Create last added as default
     */

    private function checkThatWeHaveDefaultCompany()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('is_default', 1);
        $this->db->where('is_deleted', 0);
        $num = $this->db->count_all_results('firms_users');
        if ($num == 0) {
            $this->db->limit(1);
            $this->db->order_by('id', 'desc');
            $this->db->where('for_user', USER_ID);
            $this->db->where('is_deleted', 0);
            $this->db->update('firms_users', array(
                'is_default' => 1
            ));
        }
    }

    public function getCompanyInfo($companyId)
    {
        $array = array();

        $this->db->select('id, bulstat, show_logo, is_vat_registered, vat_number');
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

    public function updateCompanyStaticInfo($post, $companyId)
    {
        $this->db->where('id', $companyId);
        $this->db->where('for_user', USER_ID);
        $bulstat = htmlspecialchars(trim($post['firm_bulstat']));
        $vatNumber = htmlspecialchars(trim($post['vat_number']));
        $showLogo = 0;
        if (isset($post['show_logo'])) {
            $showLogo = 1;
        }
        $isVatRegistered = 0;
        if (isset($post['is_vat_registered'])) {
            $isVatRegistered = 1;
        }
        if (!$this->db->update('firms_users', array(
                    'bulstat' => $bulstat,
                    'show_logo' => $showLogo,
                    'is_vat_registered' => $isVatRegistered,
                    'vat_number' => $vatNumber
                ))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
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
        if (!$this->db->update('firms_translations', array(
                    'trans_name' => htmlspecialchars(trim($post['trans_name'])),
                    'name' => htmlspecialchars(trim($post['firm_name'])),
                    'address' => htmlspecialchars(trim($post['firm_reg_address'])),
                    'city' => htmlspecialchars(trim($post['firm_city'])),
                    'mol' => htmlspecialchars(trim($post['firm_mol'])),
                    'image' => $post['image']
                ))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setNewTranslation($post, $companyId)
    {
        if (!$this->db->insert('firms_translations', array(
                    'for_firm' => $companyId,
                    'trans_name' => htmlspecialchars(trim($post['trans_name'])),
                    'name' => htmlspecialchars(trim($post['firm_name'])),
                    'address' => htmlspecialchars(trim($post['firm_reg_address'])),
                    'city' => htmlspecialchars(trim($post['firm_city'])),
                    'mol' => htmlspecialchars(trim($post['firm_mol'])),
                    'image' => $post['image'],
                    'is_default' => 0
                ))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function makeDefaultFirmWithId($firmId)
    {
        $this->db->trans_begin();
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('firms_users', array('is_default' => 0))) {
            log_message('error', print_r($this->db->error(), true));
        }

        $this->db->where('id', $firmId);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('firms_users', array('is_default' => 1))) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function makeDefaultTranslationWithId($companyId, $translationId)
    {
        $this->db->trans_begin();
        $this->db->where('for_firm', $companyId);
        if (!$this->db->update('firms_translations', array('is_default' => 0))) {
            log_message('error', print_r($this->db->error(), true));
        }

        $this->db->where('id', $translationId);
        $this->db->where('for_firm', $companyId);
        if (!$this->db->update('firms_translations', array('is_default' => 1))) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function deleteTranslation($companyId, $translationid)
    {
        $this->db->where('firms_translations.for_firm', $companyId);
        $this->db->where('for_user', USER_ID);
        $this->db->join('firms_users', 'firms_translations.for_firm = firms_users.id');
        $num = $this->db->count_all_results('firms_translations');
        if ($num > 1) {
            $query = 'DELETE firms_translations FROM firms_translations INNER JOIN firms_users ON firms_users.id = firms_translations.for_firm WHERE firms_users.for_user = ' . $this->db->escape(USER_ID) . ' AND firms_translations.id = ' . $this->db->escape($translationid);
            if (!$this->db->query($query)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            $this->checkThatWeHaveDefaultTranslate($companyId);
        }
    }

    /*
     * If we dont have default translation after delete
     * Create last added as default
     */

    private function checkThatWeHaveDefaultTranslate($companyId)
    {
        $this->db->where('for_firm', $companyId);
        $this->db->where('is_default', 1);
        $num = $this->db->count_all_results('firms_translations');
        if ($num == 0) {
            $this->db->limit(1);
            $this->db->order_by('id', 'desc');
            $this->db->where('for_firm', $companyId);
            if (!$this->db->update('firms_translations', array(
                        'is_default' => 1
                    ))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function getLastAddedCompanyId()
    {
        $this->db->select('id');
        $this->db->where('for_user', USER_ID);
        $this->db->where('is_deleted', 0);
        $this->db->limit(1);
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('firms_users');
        $row = $result->row_array();
        return $row['id'];
    }

}
