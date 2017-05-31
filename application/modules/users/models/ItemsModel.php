<?php

class ItemsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countItems()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        return $this->db->count_all_results('items');
    }

    public function getItems($limit, $page)
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('items', $limit, $page);
        return $result->result_array();
    }

    public function getItemInfo($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('items');
        return $result->row_array();
    }

    public function deleteItem($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        if (!$this->db->delete('items')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setItem($post)
    {
        $insertArray = array(
            'for_user' => USER_ID,
            'for_company' => SELECTED_COMPANY_ID,
            'name' => $post['name'],
            'quantity_type' => $post['quantity_type'],
            'single_price' => $post['single_price'],
            'currency' => $post['currency']
        );
        if ($post['editId'] > 0) {
            if (!$this->db->where('id', $post['editId'])->update('items', $insertArray)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            if (!$this->db->insert('items', $insertArray)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

}
