<?php

class ItemsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countItems($get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setItemsSearchFilter($get);
        }
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        return $this->db->count_all_results('items');
    }

    public function getItems($limit, $page, $get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setItemsSearchFilter($get);
        }
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('items', $limit, $page);
        return $result->result_array();
    }

    private function setItemsSearchFilter($get)
    {
        if (isset($get['item_name']) && $get['item_name'] != '') {
            $this->db->like('name', $get['item_name']);
        }
        if (isset($get['amount_from']) && $get['amount_from'] != '') {
            $this->db->where('single_price >=', (float) $get['amount_from']);
        }
        if (isset($get['amount_to']) && $get['amount_to'] != '') {
            $this->db->where('single_price >=', (float) $get['amount_to']);
        }
    }

    public function getItemInfo($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('items');
        return $result->row_array();
    }

    private function setInvoicesSearchFilter($get)
    {
        if (isset($get['client_name']) && $get['client_name'] != '') {
            $this->db->like('client_name', $get['client_name']);
        }
        if (isset($get['client_bulstat']) && $get['client_bulstat'] != '') {
            $this->db->like('client_bulstat', $get['client_bulstat']);
        }
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
            'name' => htmlspecialchars(trim($post['name'])),
            'quantity_type' => htmlspecialchars(trim($post['quantity_type'])),
            'single_price' => htmlspecialchars(trim($post['single_price'])),
            'currency' => htmlspecialchars(trim($post['currency']))
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

    public function multipleDeleteItems($ids)
    {
        if ($ids != null && is_array($ids)) {
            $this->db->where_in('id', $ids);
            $this->db->where('for_user', USER_ID);
            $this->db->where('for_company', SELECTED_COMPANY_ID);
            if (!$this->db->delete('items')) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

}
