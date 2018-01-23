<?php

class WarrantyCardModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countWarranties($get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setWarrantiesSearchFilter($get);
        }
        $this->db->where('warranties.for_user', USER_ID);
        $this->db->where('warranties.for_company', SELECTED_COMPANY_ID);
        $this->db->join('warranties_clients', 'warranties_clients.for_warranty = warranties.id');
        $this->db->where('warranties.is_deleted', 0);
        return $this->db->count_all_results('warranties');
    }

    public function getWarranties($limit, $page, $get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setWarrantiesSearchFilter($get);
        }
        $this->db->select('warranties.*, warranties_clients.client_name as client');
        $this->db->join('warranties_firms', 'warranties_firms.for_warranty = warranties.id');
        $this->db->join('warranties_clients', 'warranties_clients.for_warranty = warranties.id');
        $this->db->order_by('warranties.id', 'desc');
        $this->db->where('warranties.for_user', USER_ID);
        $this->db->where('warranties.for_company', SELECTED_COMPANY_ID);
        $this->db->where('warranties.is_deleted', 0);
        $result = $this->db->get('warranties', $limit, $page);
        return $result->result_array();
    }

    private function setWarrantiesSearchFilter($get)
    {
        if (isset($get['client_name']) && trim($get['client_name']) != '') {
            $this->db->like('warranties_clients.client_name', trim($get['client_name']));
        }
        if (isset($get['create_from']) && trim($get['create_from']) != '') {
            $from = strtotime($get['create_from']);
            if ($from != false) {
                $this->db->where('created >=', $from);
            }
        }
        if (isset($get['create_to']) && trim($get['create_to']) != '') {
            $to = strtotime($get['create_to']);
            if ($to != false) {
                $this->db->where('created <=', $to);
            }
        }
    }

    public function multipleDeleteWarranties($ids)
    {
        if ($ids != null && is_array($ids)) {
            $this->db->where_in('id', $ids);
            $this->db->where('for_user', USER_ID);
            $this->db->where('for_company', SELECTED_COMPANY_ID);
            if (!$this->db->update('warranties', array('is_deleted' => 1))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function setWarranty($post)
    {
        $this->db->trans_begin();

        $warrantyArray = array(
            'for_user' => USER_ID,
            'for_company' => SELECTED_COMPANY_ID,
            'warranty_number' => htmlspecialchars(trim($post['warranty_number'])),
            'valid_from' => strtotime($post['valid_from_date']),
            'received' => htmlspecialchars(trim($post['received'])),
            'compiled' => htmlspecialchars(trim($post['compiled'])),
            'conditions' => htmlspecialchars(trim($post['conditions'])),
            'remarks' => htmlspecialchars(trim($post['remarks'])),
            'created' => time()
        );
        if (!$this->db->insert('warranties', $warrantyArray)) {
            log_message('error', print_r($this->db->error(), true));
        }

        $warrantyId = $this->db->insert_id();

        $this->setWarrantyClient($post, $warrantyId);
        $this->setWarrantyItems($post, $warrantyId);
        $this->setWarrantyFirm($post, $warrantyId);
        $this->setWarrantyTranslation($post['warranty_translation'], $warrantyId);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function updateWarranty($post)
    {
        $this->db->trans_begin();

        $warrantyArray = array(
            'warranty_number' => htmlspecialchars($post['warranty_number']),
            'received' => htmlspecialchars($post['received']),
            'compiled' => htmlspecialchars($post['compiled']),
            'valid_from' => strtotime($post['valid_from_date']),
            'conditions' => htmlspecialchars($post['conditions']),
            'remarks' => htmlspecialchars($post['remarks'])
        );
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('id', $post['editId']);
        if (!$this->db->update('warranties', $warrantyArray)) {
            log_message('error', print_r($this->db->error(), true));
        }

        $warrantyId = $post['updateId'];

        $this->updateWarrantyClient($post, $warrantyId);
        $this->updateWarrantyItems($post, $warrantyId);
        $this->updateWarrantyFirm($post, $warrantyId);
        $this->updateWarrantyTranslation($post['warranty_translation'], $warrantyId);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    private function updateWarrantyClient($post, $warrantyId)
    {
        $is_to_person = isset($post['is_to_person']) ? 1 : 0;
        $client_vat_registered = isset($post['client_vat_registered']) ? 1 : 0;
        $insertArray = array(
            'client_name' => htmlspecialchars(trim($post['client_name'])),
            'client_bulstat' => htmlspecialchars(trim($post['client_bulstat'])),
            'is_to_person' => $is_to_person,
            'client_vat_registered' => $client_vat_registered,
            'vat_number' => htmlspecialchars(trim($post['vat_number'])),
            'client_ident_num' => htmlspecialchars(trim($post['client_ident_num'])),
            'client_address' => htmlspecialchars(trim($post['client_address'])),
            'client_city' => htmlspecialchars(trim($post['client_city'])),
            'client_country' => htmlspecialchars(trim($post['client_country'])),
            'accountable_person' => htmlspecialchars(trim($post['accountable_person'])),
            'recipient_name' => htmlspecialchars(trim($post['client_name']))
        );
        $this->db->where('for_warranty', $warrantyId);
        if (!$this->db->update('warranties_clients ', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function updateWarrantyItems($post, $warrantyId)
    {
        $numItems = count($post['items_names']) - 1;
        $i = 0;
        $position = 1;
        $deleteIds = array();
        foreach (explode(',', $post['onLoadItems']) as $onLoadItem) {
            if (!in_array($onLoadItem, $post['is_item_update'])) {
                $deleteIds[] = $onLoadItem;
            }
        }
        if (!empty($deleteIds)) {
            $this->db->where('for_warranty', $warrantyId);
            $this->db->where_in('id', $deleteIds);
            if (!$this->db->delete('warranties_items')) {
                log_message('error', print_r($this->db->error(), true));
            }
        }
        while ($i <= $numItems) {
            /*
             * If is update, update the item
             * else insert the new
             */
            if ($post['is_item_update'][$i] > 0) {
                $arrItem = array(
                    'name' => htmlspecialchars($post['items_names'][$i]),
                    'months' => $post['items_months'][$i],
                    'valid_to' => strtotime('+ ' . (int) $post['items_months'][$i] . ' months', strtotime($post['valid_from_date'])),
                    'serial' => htmlspecialchars($post['items_serial_nums'][$i]),
                    'position' => $position
                );
                $this->db->where('for_warranty', $warrantyId);
                $this->db->where('id', $post['is_item_update'][$i]);
                if (!$this->db->update('warranties_items', $arrItem)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            } else {
                $arrItem = array(
                    'for_warranty' => $warrantyId,
                    'name' => htmlspecialchars($post['items_names'][$i]),
                    'months' => htmlspecialchars($post['items_months'][$i]),
                    'serial' => htmlspecialchars($post['items_serial_nums'][$i]),
                    'position' => $position
                );
                if (!$this->db->insert('warranties_items', $arrItem)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            $i++;
            $position++;
        }
    }

    private function updateWarrantyFirm($post, $warrantyId)
    {
        $this->db->where('firms_translations.id', $post['warranty_firm_translation']);
        $this->db->where('firms_users.for_user', USER_ID);
        $this->db->where('firms_users.id', SELECTED_COMPANY_ID);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        $firm = $result->row_array();

        $insertArray = array(
            'bulstat' => $firm['bulstat'],
            'name' => $firm['name'],
            'address' => $firm['address'],
            'city' => $firm['city'],
            'accountable_person' => $firm['mol'],
            'is_vat_registered' => $firm['is_vat_registered'],
            'vat_number' => $firm['vat_number'],
            'image' => $firm['image'] == null ? '' : $firm['image']
        );
        $this->db->where('for_warranty', $warrantyId);
        if (!$this->db->update('warranties_firms`', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function updateWarrantyTranslation($translateId, $warrantyId)
    {
        if ($translateId == '0') {
            $this->db->where('id', 1);
        } else {
            $this->db->where('for_user', USER_ID);
            $this->db->where('id', $translateId);
        }
        $result = $this->db->get('warranties_languages');
        $translate = $result->row_array();
        unset($translate['id']);
        unset($translate['for_user']);
        $this->db->where('for_warranty', $warrantyId);
        if (!$this->db->update('warranties_translations', $translate)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function setWarrantyClient($post, $warrantyId)
    {
        $is_to_person = isset($post['is_to_person']) ? 1 : 0;
        $client_vat_registered = isset($post['client_vat_registered']) ? 1 : 0;
        $insertArray = array(
            'for_warranty' => $warrantyId,
            'client_name' => htmlspecialchars(trim($post['client_name'])),
            'client_bulstat' => htmlspecialchars(trim($post['client_bulstat'])),
            'is_to_person' => $is_to_person,
            'client_vat_registered' => $client_vat_registered,
            'vat_number' => htmlspecialchars(trim($post['vat_number'])),
            'client_ident_num' => htmlspecialchars(trim($post['client_ident_num'])),
            'client_address' => htmlspecialchars(trim($post['client_address'])),
            'client_city' => htmlspecialchars(trim($post['client_city'])),
            'client_country' => htmlspecialchars(trim($post['client_country'])),
            'accountable_person' => htmlspecialchars(trim($post['accountable_person'])),
            'recipient_name' => htmlspecialchars(trim($post['client_name']))
        );
        if (!$this->db->insert('warranties_clients ', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function setWarrantyItems($post, $warrantyId)
    {
        $numItems = count($post['items_names']) - 1;
        $i = 0;
        $position = 1;
        while ($i <= $numItems) {
            $arrItem = array(
                'for_warranty' => $warrantyId,
                'name' => htmlspecialchars($post['items_names'][$i]),
                'months' => htmlspecialchars($post['items_months'][$i]),
                'valid_to' => strtotime('+ ' . (int) $post['items_months'][$i] . ' months', strtotime($post['valid_from_date'])),
                'serial' => htmlspecialchars($post['items_serial_nums'][$i]),
                'position' => $position
            );
            if (!$this->db->insert('warranties_items', $arrItem)) {
                log_message('error', print_r($this->db->error(), true));
            }
            $i++;
            $position++;
        }
    }

    private function setWarrantyFirm($post, $warrantyId)
    {
        $this->db->where('firms_translations.id', $post['warranty_firm_translation']);
        $this->db->where('firms_users.for_user', USER_ID);
        $this->db->where('firms_users.id', SELECTED_COMPANY_ID);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        $firm = $result->row_array();

        $insertArray = array(
            'for_warranty' => $warrantyId,
            'bulstat' => $firm['bulstat'],
            'name' => $firm['name'],
            'address' => $firm['address'],
            'city' => $firm['city'],
            'accountable_person' => $firm['mol'],
            'is_vat_registered' => $firm['is_vat_registered'],
            'vat_number' => $firm['vat_number'],
            'image' => $firm['image'] == null ? '' : $firm['image']
        );
        if (!$this->db->insert('warranties_firms`', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function setWarrantyTranslation($translateId, $warrantyId)
    {
        if ($translateId == '0') {
            $this->db->where('id', 1);
        } else {
            $this->db->where('for_user', USER_ID);
            $this->db->where('id', $translateId);
        }
        $result = $this->db->get('warranties_languages');
        $translate = $result->row_array();
        unset($translate['id']);
        unset($translate['for_user']);
        $translate['for_warranty'] = $warrantyId;
        if (!$this->db->insert('warranties_translations', $translate)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function getNextFreeWarrantyNumber()
    {
        $this->db->select_max('warranty_number');
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('warranties.is_deleted', 0);
        $result = $this->db->get('warranties');
        $row = $result->row_array();

        if (empty($row)) {
            return full_document_number(1);
        } else {
            return full_document_number($row['warranty_number'] + 1);
        }
    }

    public function getMyWarrantiesLanguages()
    {
        $this->db->select('id, language_name');
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('warranties_languages');
        return $result->result_array();
    }

    public function setNewWarrantyLanguage($post)
    {
        unset($post['addNewWarrantyTranslation']);
        $post['for_user'] = USER_ID;
        if (!$this->db->insert('warranties_languages', $post)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function checkIsFreeWarrantyNumber($number, $without = 0)
    {
        if ($without > 0) {
            $this->db->where('id !=', $without);
        }
        $this->db->where('warranty_number', $number);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('warranties.is_deleted', 0);
        $num = $this->db->count_all_results('warranties');
        if ($num > 0) {
            return false;
        }
        return true;
    }

    public function getWarrantyByNumber($number)
    {
        $this->db->where('warranties.warranty_number', (int) $number);
        $this->db->where('warranties.for_user', USER_ID);
        $this->db->where('warranties.for_company', SELECTED_COMPANY_ID);
        $this->db->where('warranties.is_deleted', 0);
        $this->db->limit(1);
        $result = $this->db->get('warranties');
        $arr = $result->row_array();
        if (empty($arr)) {
            return $arr;
        }

        $result = $this->db->where('for_warranty', $arr['id'])->order_by('position', 'asc')->get('warranties_items');
        $items = $result->result_array();
        $arr['items'] = $items;

        $result = $this->db->where('for_warranty', $arr['id'])->get('warranties_clients');
        $client = $result->row_array();
        $arr['client'] = $client;

        $result = $this->db->where('for_warranty', $arr['id'])->get('warranties_firms');
        $firm = $result->row_array();
        $arr['firm'] = $firm;

        $result = $this->db->where('for_warranty', $arr['id'])->get('warranties_translations');
        $translation = $result->row_array();
        $arr['translation'] = $translation;
        return $arr;
    }

    public function setNewCondition($post)
    {
        $insertArray = array(
            'for_user' => USER_ID,
            'condition_title' => $post['conditionTitle'],
            'condition_description' => $post['condition']
        );
        if (!$this->db->insert('warranty_conditions`', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getWarrantyConditions()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('warranty_conditions');
        return $result->result_array();
    }

    public function deleteWarrantyCondition($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('warranty_conditions')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setWarrantyEvent($post, $warrantyId)
    {
        $insertArray = array(
            'for_warranty' => $warrantyId,
            'type' => htmlspecialchars(trim($post['type'])),
            'on_date' => strtotime(trim($post['on_date'])),
            'item' => htmlspecialchars(trim($post['item'])),
            'description' => htmlspecialchars(trim($post['description'])),
            'created' => time()
        );
        if (!$this->db->insert('warranty_events`', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getWarrantyEvents($id)
    {
        $this->db->where('for_warranty', $id);
        $result = $this->db->get('warranty_events');
        return $result->result_array();
    }

}
