<?php

class StoreModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countMovements($get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setMovementsSearchFilter($get);
        }
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        return $this->db->count_all_results('movements');
    }

    public function getMovements($limit, $page, $get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setMovementsSearchFilter($get);
        }
        $this->db->select('movements.*, movements_firms.name as firm_name, movements_clients.client_name, movements_from_to_store.from_store, movements_from_to_store.to_store');
        $this->db->join('movements_firms', 'movements_firms.for_movement = movements.id');
        $this->db->join('movements_clients', 'movements_clients.for_movement = movements.id');
        $this->db->join('movements_from_to_store', 'movements_from_to_store.for_movement = movements.id', 'left');
        $this->db->order_by('id', 'asc');
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('movements', $limit, $page);
        return $result->result_array();
    }

    private function setMovementsSearchFilter($get)
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

    public function getStores()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('is_deleted', 0);
        $result = $this->db->get('stores');
        return $result->result_array();
    }

    public function getItemsForStoreAction($search, $fromStore, $movementType)
    {
        $this->db->where('items.for_user', USER_ID);
        $this->db->where('items.for_company', SELECTED_COMPANY_ID);
        $this->db->like('items.name', $search);

        $result = $this->db->get('items');
        return $result->result_array();
    }

    public function setMovement($post)
    {
        $this->db->trans_begin();

        $storeMoveArr = array(
            'for_user' => USER_ID,
            'for_company' => SELECTED_COMPANY_ID,
            'movement_type' => $post['type'],
            'movement_number' => $post['movement_number'],
            'store_id' => $post['selected_store'],
            'movement_currency' => $post['movement_currency'],
            'amount' => $post['amount'],
            'discount' => $post['discount'],
            'discount_type' => $post['discount_type'],
            'tax_base' => $post['tax_base'],
            'vat_percent' => $post['vat_percent'],
            'vat_sum' => $post['vat_sum'],
            'no_vat_reason' => $post['no_vat_reason'],
            'final_total' => $post['final_total'],
            'remarks' => $post['remarks'],
            'payment_method' => $post['payment_method'],
            'created' => strtotime($post['date_create'])
        );
        if (!$this->db->insert('movements', $storeMoveArr)) {
            log_message('error', print_r($this->db->error(), true));
        }

        $movementId = $this->db->insert_id();

        $this->setClient($post, $movementId);
        $this->setMovementFirm($post, $movementId);
        $this->setMovementTranslation($post['movement_translation'], $movementId);
        $this->setMovementItems($post, $movementId);
        $this->updateStoreQuantities($post, $movementId);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    private function setClient($post, $movementId)
    {

        $is_to_person = isset($post['is_to_person']) ? 1 : 0;
        $client_vat_registered = isset($post['client_vat_registered']) ? 1 : 0;
        $insertArray = array(
            'for_movement' => $movementId,
            'client_name' => $post['client_name'],
            'client_bulstat' => $post['client_bulstat'],
            'is_to_person' => $is_to_person,
            'client_vat_registered' => $client_vat_registered,
            'vat_number' => $post['vat_number'],
            'client_ident_num' => $post['client_ident_num'],
            'client_address' => $post['client_address'],
            'client_city' => $post['client_city'],
            'client_country' => $post['client_country'],
            'accountable_person' => $post['accountable_person'],
            'recipient_name' => $post['client_name']
        );
        if (!$this->db->insert('movements_clients ', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function setMovementItems($post, $movementId)
    {
        $numItems = count($post['items_names']) - 1;
        $i = 0;
        $position = 1;
        while ($i <= $numItems) {
            $arrItem = array(
                'for_movement' => $movementId,
                'name' => $post['items_names'][$i],
                'quantity' => $post['items_quantities'][$i],
                'quantity_type' => $post['items_quantity_types'][$i],
                'single_price' => $post['items_prices'][$i],
                'total_price' => $post['items_totals'][$i],
                'position' => $position
            );
            if (!$this->db->insert('movement_items', $arrItem)) {
                log_message('error', print_r($this->db->error(), true));
            }
            $i++;
            $position++;
        }
    }

    private function setMovementFirm($post, $movementId)
    {
        $this->db->where('firms_translations.id', $post['movement_firm_translation']);
        $this->db->where('firms_users.for_user', USER_ID);
        $this->db->where('firms_users.id', SELECTED_COMPANY_ID);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        $firm = $result->row_array();

        $insertArray = array(
            'for_movement' => $movementId,
            'bulstat' => $firm['bulstat'],
            'name' => $firm['name'],
            'address' => $firm['address'],
            'city' => $firm['city'],
            'accountable_person' => $firm['mol'],
            'image' => $firm['image'] == null ? '' : $firm['image']
        );
        if (!$this->db->insert('movements_firms`', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function setMovementTranslation($translateId, $movementId)
    {
        if ($translateId == '0') {
            $this->db->where('id', 1);
        } else {
            $this->db->where('for_user', USER_ID);
            $this->db->where('id', $translateId);
        }
        $result = $this->db->get('movements_languages');
        $translate = $result->row_array();
        unset($translate['id']);
        unset($translate['for_user']);
        $translate['for_movement'] = $translateId;
        if (!$this->db->insert('movements_translations', $translate)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function updateStoreQuantities($post, $movementId)
    {
        $numItems = count($post['items_names']) - 1;
        $i = 0;
        while ($i <= $numItems) {
            // if type is - add stock availability
            if ($post['type'] == 'in') {
                $this->db->where('for_user', USER_ID);
                $this->db->where('for_company', SELECTED_COMPANY_ID);
                $this->db->where('for_store', $post['selected_store']);
                $this->db->where('item_id', (int) $post['item_from_list'][$i]);
                $num = $this->db->count_all_results('stock_availability');
                if ($num > 0) {
                    $insert = false;
                } else {
                    $insert = true;
                }
                if ($insert === true) {
                    $data = array(
                        'for_user' => USER_ID,
                        'for_company' => SELECTED_COMPANY_ID,
                        'for_store' => $post['selected_store'],
                        'item_id' => (int) $post['item_from_list'][$i],
                        'quantity' => (float) $post['items_quantities'][$i]
                    );
                    if (!$this->db->insert('stock_availability', $data)) {
                        log_message('error', print_r($this->db->error(), true));
                    }
                } else {
                    $this->db->set('quantity', 'quantity+' . (float) $post['items_quantities'][$i], FALSE);
                    $this->db->where('for_user', USER_ID);
                    $this->db->where('for_company', SELECTED_COMPANY_ID);
                    $this->db->where('for_store', $post['selected_store']);
                    $this->db->where('item_id', (int) $post['item_from_list'][$i]);
                    if (!$this->db->update('stock_availability')) {
                        log_message('error', print_r($this->db->error(), true));
                    }
                }
            }
            // if type is - remove from stock availability
            if ($post['type'] == 'out') {
                $this->db->set('quantity', 'quantity-' . (float) $post['items_quantities'][$i], FALSE);
                $this->db->where('for_user', USER_ID);
                $this->db->where('for_company', SELECTED_COMPANY_ID);
                $this->db->where('for_store', $post['selected_store']);
                $this->db->where('item_id', (int) $post['item_from_list'][$i]);
                if (!$this->db->update('stock_availability')) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            // if type is - move stock from one store to other
            if ($post['type'] == 'move') {
                $this->db->select('quantity');
                $this->db->where('for_user', USER_ID);
                $this->db->where('for_company', SELECTED_COMPANY_ID);
                $this->db->where('for_store', $post['selected_store']);
                $this->db->where('item_id', (int) $post['item_from_list'][$i]);
                $res = $this->db->get('stock_availability');
                $row = $res->row_array();
                $quantity = $row['quantity'];

                $this->db->set('quantity', 'quantity-' . (float) $post['items_quantities'][$i], FALSE);
                $this->db->where('for_user', USER_ID);
                $this->db->where('for_company', SELECTED_COMPANY_ID);
                $this->db->where('for_store', $post['selected_store']);
                $this->db->where('item_id', (int) $post['item_from_list'][$i]);
                if (!$this->db->update('stock_availability')) {
                    log_message('error', print_r($this->db->error(), true));
                }

                $this->db->where('for_user', USER_ID);
                $this->db->where('for_company', SELECTED_COMPANY_ID);
                $this->db->where('for_store', $post['selected_to_store']);
                $this->db->where('item_id', (int) $post['item_from_list'][$i]);
                $num = $this->db->count_all_results('stock_availability');
                if ($num > 0) {
                    $insert = false;
                } else {
                    $insert = true;
                }
                if ($insert === true) {
                    $data = array(
                        'for_user' => USER_ID,
                        'for_company' => SELECTED_COMPANY_ID,
                        'for_store' => $post['selected_to_store'],
                        'item_id' => (int) $post['item_from_list'][$i],
                        'quantity' => (float) $post['items_quantities'][$i]
                    );
                    if (!$this->db->insert('stock_availability', $data)) {
                        log_message('error', print_r($this->db->error(), true));
                    }
                } else {
                    $this->db->set('quantity', 'quantity+' . (float) $post['items_quantities'][$i], FALSE);
                    $this->db->where('for_user', USER_ID);
                    $this->db->where('for_company', SELECTED_COMPANY_ID);
                    $this->db->where('for_store', $post['selected_to_store']);
                    $this->db->where('item_id', (int) $post['item_from_list'][$i]);
                    if (!$this->db->update('stock_availability')) {
                        log_message('error', print_r($this->db->error(), true));
                    }
                }

                $from = $this->getStoreNameById($post['selected_store']);
                $to = $this->getStoreNameById($post['selected_to_store']);
                if (!$this->db->insert('movements_from_to_store', array(
                            'for_movement' => $movementId,
                            'from_store' => $from,
                            'to_store' => $to
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            if ($post['type'] == 'revision') {
                $this->db->select('quantity');
                $this->db->where('for_user', USER_ID);
                $this->db->where('for_company', SELECTED_COMPANY_ID);
                $this->db->where('for_store', $post['selected_store']);
                $this->db->where('item_id', (int) $post['item_from_list'][$i]);
                $result = $this->db->get('stock_availability');
                $row = $result->row_array();
                $currentQuantityInStore = $row['quantity'];

                $currentQuantity = (float) $post['items_quantities'][$i];

                if (!$this->db->insert('movements_revisions', array(
                            'for_movement' => $movementId,
                            'name' => 'aa',
                            'before_revision' => $currentQuantityInStore,
                            'after_revision' => $currentQuantity,
                            'difference' => $currentQuantity - $currentQuantityInStore
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            $i++;
        }
    }

    private function getStoreNameById($id)
    {
        $this->db->select('name');
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('stores');
        $row = $result->row_array();
        return $row['name'];
    }

    public function getMyMovementsLanguages()
    {
        $this->db->select('id, language_name');
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('movements_languages');
        return $result->result_array();
    }

    public function getNextFreeInvoiceNumber()
    {
        $this->db->select_max('movement_number');
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $result = $this->db->get('movements');
        $row = $result->row_array();

        if (empty($row)) {
            return full_document_number(1);
        } else {
            return full_document_number($row['movement_number'] + 1);
        }
    }

    public function checkIsFreeMovementNumber($number)
    {
        $this->db->where('movement_number', $number);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $num = $this->db->count_all_results('movements');
        if ($num > 0) {
            return false;
        }
        return true;
    }

    public function checkStoreHaveItem($store, $itemId)
    {
        $this->db->where('item_id', $itemId);
        $this->db->where('for_store', $store);
        $num = $this->db->count_all_results('stock_availability');
        if ($num > 0) {
            return false;
        }
        return true;
    }

    public function checkHaveEnoughtQuantity($store, $itemId)
    {
        $this->db->select('quantity');
        $this->db->where('item_id', $itemId);
        $this->db->where('for_store', $store);
        $result = $this->db->get('stock_availability');
        $row = $result->row_array();
        if ($row == null) {
            return null;
        }
        return $row['quantity'];
    }

    public function setNewMovementLanguage($post)
    {
        unset($post['addNewMovementTranslation']);
        $post['for_user'] = USER_ID;
        if (!$this->db->insert('movements_languages', $post)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

}
