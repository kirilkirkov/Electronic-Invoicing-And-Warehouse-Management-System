<?php

class ManagefirmsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function deleteCompany($companyId, $userId)
    {
        $this->db->limit(1);
        $this->db->where('id', $companyId);
        $this->db->where('for_user', $userId);
        $result = $this->db->update('firms_users', array('is_deleted' => 1));
        if ($result == false) {
            log_message('error', 'Cant delete firm with id - ' . $companyId . ' and userid - ' . $userId);
        }
    }

}
