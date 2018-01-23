<?php

class ProtocolsModel extends CI_Model
{
    /*
     * Ids in database of the default 
     * invoice languages in table "protocols_languages"
     * JUST HARDCODED $sysDefTransIds
     * They must be same in $sysDefTransIds, addprotocol.php(view) and in "protocols_languages" table
     */

    private $sysDefTransIds = array(1, 2, 3);

    public function __construct()
    {
        parent::__construct();
    }

    public function countProtocols($get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setProtocolsSearchFilter($get);
        }
        $this->db->where('protocols.for_user', USER_ID);
        $this->db->where('protocols.for_company', SELECTED_COMPANY_ID);
        $this->db->join('protocols_clients', 'protocols_clients.for_protocol = protocols.id');
        $this->db->where('protocols.is_deleted', 0);
        return $this->db->count_all_results('protocols');
    }

    public function getProtocols($limit, $page, $get = null)
    {
        if (!empty($get) && $get != null) {
            $this->setProtocolsSearchFilter($get);
        }
        $this->db->select('protocols.*, protocols_clients.client_name as client');
        $this->db->join('protocols_firms', 'protocols_firms.for_protocol = protocols.id');
        $this->db->join('protocols_clients', 'protocols_clients.for_protocol = protocols.id');
        $this->db->order_by('protocols.id', 'desc');
        $this->db->where('protocols.for_user', USER_ID);
        $this->db->where('protocols.for_company', SELECTED_COMPANY_ID);
        $this->db->where('protocols.is_deleted', 0);
        $result = $this->db->get('protocols', $limit, $page);
        return $result->result_array();
    }

    private function setProtocolsSearchFilter($get)
    {
        if (isset($get['client_name']) && trim($get['client_name']) != '') {
            $this->db->like('protocols_clients.client_name', trim($get['client_name']));
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

    public function getProviderTransmits()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('protocols_provider_transmit');
        return $result->result_array();
    }

    public function setProviderTransmitText($post)
    {
        $insertArray = array(
            'for_user' => USER_ID,
            'title' => $post['title'],
            'description' => $post['description']
        );
        if (!$this->db->insert('protocols_provider_transmit`', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function deleteProviderTransmitText($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('protocols_provider_transmit')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setContract($post)
    {
        $insertArray = array(
            'for_user' => USER_ID,
            'title' => $post['title_contract'],
            'contract' => $post['contract']
        );
        if (!$this->db->insert('protocols_contracts`', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function deleteContract($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('protocols_contracts')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getContracts()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('protocols_contracts');
        return $result->result_array();
    }

    public function getNextFreeProtocolNumber()
    {
        $this->db->select_max('protocol_number');
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('protocols.is_deleted', 0);
        $result = $this->db->get('protocols');
        $row = $result->row_array();

        if (empty($row)) {
            return full_document_number(1);
        } else {
            return full_document_number($row['protocol_number'] + 1);
        }
    }

    public function getMyProtocolsLanguages()
    {
        $this->db->select('id, language_name');
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('protocols_languages');
        return $result->result_array();
    }

    public function setNewProtocolLanguage($post)
    {
        unset($post['addNewProtocolTranslation']);
        $post['for_user'] = USER_ID;
        if (!$this->db->insert('protocols_languages', $post)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function checkIsFreeProtocolNumber($number, $without = 0)
    {
        if ($without > 0) {
            $this->db->where('id !=', $without);
        }
        $this->db->where('protocol_number', $number);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('protocols.is_deleted', 0);
        $num = $this->db->count_all_results('protocols');
        if ($num > 0) {
            return false;
        }
        return true;
    }

    public function setProtocol($post)
    {
        $this->db->trans_begin();

        $protocolsArray = array(
            'for_user' => USER_ID,
            'for_company' => SELECTED_COMPANY_ID,
            'protocol_number' => htmlspecialchars(trim($post['protocol_number'])),
            'type' => htmlspecialchars(trim($post['type'])),
            'from_date' => strtotime($post['from_date']),
            'to_invoice' => htmlspecialchars(trim($post['to_invoice'])),
            'compiled' => htmlspecialchars(trim($post['compiled'])),
            'received' => htmlspecialchars(trim($post['received'])),
            'remarks' => htmlspecialchars(trim($post['remarks'])),
            'provider_transmit' => htmlspecialchars(trim($post['provider_trasmit'])),
            'contract' => htmlspecialchars(trim($post['contract'])),
            'amount' => htmlspecialchars(trim($post['amount'])),
            'vat_percent' => htmlspecialchars(trim($post['vat_percent'])),
            'vat_sum' => htmlspecialchars(trim($post['vat_sum'])),
            'final_total' => htmlspecialchars(trim($post['final_total'])),
            'currency' => htmlspecialchars(trim($post['currency'])),
            'created' => time()
        );
        if (!$this->db->insert('protocols', $protocolsArray)) {
            log_message('error', print_r($this->db->error(), true));
        }

        $protocolId = $this->db->insert_id();

        $this->setProtocolClient($post, $protocolId);
        $this->setProtocolItems($post, $protocolId);
        $this->setProtocolFirm($post, $protocolId);
        $this->setProtocolTranslation($post['protocol_translation'], $protocolId);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function updateProtocol($post)
    {
        $this->db->trans_begin();

        $protocolArray = array(
            'protocol_number' => htmlspecialchars(trim($post['protocol_number'])),
            'from_date' => strtotime($post['from_date']),
            'to_invoice' => htmlspecialchars(trim($post['to_invoice'])),
            'type' => htmlspecialchars(trim($post['type'])),
            'compiled' => htmlspecialchars(trim($post['compiled'])),
            'received' => htmlspecialchars(trim($post['received'])),
            'remarks' => htmlspecialchars(trim($post['remarks'])),
            'provider_transmit' => htmlspecialchars(trim($post['provider_transmit'])),
            'contract' => htmlspecialchars(trim($post['contract'])),
            'amount' => htmlspecialchars(trim($post['amount'])),
            'vat_percent' => htmlspecialchars(trim($post['vat_percent'])),
            'vat_sum' => htmlspecialchars(trim($post['vat_sum'])),
            'currency' => htmlspecialchars(trim($post['currency'])),
            'final_total' => htmlspecialchars(trim($post['final_total'])),
        );
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('id', $post['editId']);
        if (!$this->db->update('protocols', $protocolArray)) {
            log_message('error', print_r($this->db->error(), true));
        }

        $protocolID = $post['editId'];

        $this->updateProtocolClient($post, $protocolID);
        $this->updateProtocolItems($post, $protocolID);
        $this->updateProtocolFirm($post, $protocolID);
        $this->updateProtocolTranslation($post['protocol_translation'], $protocolID);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    private function updateProtocolClient($post, $protocolArray)
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
        $this->db->where('for_protocol', $protocolArray);
        if (!$this->db->update('protocols_clients ', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function updateProtocolItems($post, $protocolId)
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
            $this->db->where('for_protocol', $protocolId);
            $this->db->where_in('id', $deleteIds);
            if (!$this->db->delete('protocols_items')) {
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
                    'name' => htmlspecialchars(trim($post['items_names'][$i])),
                    'quantity' => htmlspecialchars(trim($post['items_quantities'][$i])),
                    'quantity_type' => htmlspecialchars(trim($post['items_quantity_types'][$i])),
                    'single_price' => htmlspecialchars(trim($post['items_prices'][$i])),
                    'total_price' => htmlspecialchars(trim($post['items_totals'][$i])),
                    'position' => $position
                );
                if (!$this->db->where('for_protocol', $protocolId)->where('id', $post['is_item_update'][$i])->update('protocols_items', $arrItem)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            } else {
                $arrItem = array(
                    'for_protocol' => $protocolId,
                    'for_user' => USER_ID,
                    'for_company' => SELECTED_COMPANY_ID,
                    'name' => htmlspecialchars(trim($post['items_names'][$i])),
                    'quantity' => htmlspecialchars(trim($post['items_quantities'][$i])),
                    'quantity_type' => htmlspecialchars(trim($post['items_quantity_types'][$i])),
                    'single_price' => htmlspecialchars(trim($post['items_prices'][$i])),
                    'total_price' => htmlspecialchars(trim($post['items_totals'][$i])),
                    'position' => $position
                );
                if (!$this->db->insert('protocols_items', $arrItem)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            $i++;
            $position++;
        }
    }

    private function updateProtocolFirm($post, $protocolId)
    {
        $this->db->where('firms_translations.id', $post['protocol_firm_translation']);
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
        $this->db->where('for_protocol', $protocolId);
        if (!$this->db->update('protocols_firms`', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function updateProtocolTranslation($translateId, $protocolId)
    {
        if (in_array($translateId, $this->sysDefTransIds)) {
            $this->db->where('id', $translateId);
        } else {
            $this->db->where('for_user', USER_ID);
            $this->db->where('id', $translateId);
        }
        $result = $this->db->get('protocols_languages');
        $translate = $result->row_array();
        unset($translate['id']);
        unset($translate['for_user']);
        $this->db->where('for_protocol', $protocolId);
        if (!$this->db->update('protocols_translations', $translate)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function setProtocolClient($post, $prodocolId)
    {
        $is_to_person = isset($post['is_to_person']) ? 1 : 0;
        $client_vat_registered = isset($post['client_vat_registered']) ? 1 : 0;
        $insertArray = array(
            'for_protocol' => $prodocolId,
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
        if (!$this->db->insert('protocols_clients ', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function setProtocolItems($post, $protocolId)
    {
        $numItems = count($post['items_names']) - 1;
        $i = 0;
        $position = 1;
        while ($i <= $numItems) {
            $arrItem = array(
                'for_protocol' => $protocolId,
                'for_user' => USER_ID,
                'for_company' => SELECTED_COMPANY_ID,
                'name' => htmlspecialchars(trim($post['items_names'][$i])),
                'quantity' => htmlspecialchars(trim($post['items_quantities'][$i])),
                'quantity_type' => htmlspecialchars(trim($post['items_quantity_types'][$i])),
                'single_price' => htmlspecialchars(trim($post['items_prices'][$i])),
                'total_price' => htmlspecialchars(trim($post['items_totals'][$i])),
                'position' => $position
            );
            if (!$this->db->insert('protocols_items', $arrItem)) {
                log_message('error', print_r($this->db->error(), true));
            }
            $i++;
            $position++;
        }
    }

    private function setProtocolFirm($post, $protocolId)
    {
        $this->db->where('firms_translations.id', $post['protocol_firm_translation']);
        $this->db->where('firms_users.for_user', USER_ID);
        $this->db->where('firms_users.id', SELECTED_COMPANY_ID);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        $firm = $result->row_array();

        $insertArray = array(
            'for_protocol' => $protocolId,
            'bulstat' => $firm['bulstat'],
            'name' => $firm['name'],
            'address' => $firm['address'],
            'city' => $firm['city'],
            'accountable_person' => $firm['mol'],
            'is_vat_registered' => $firm['is_vat_registered'],
            'vat_number' => $firm['vat_number'],
            'image' => $firm['image'] == null ? '' : $firm['image']
        );
        if (!$this->db->insert('protocols_firms`', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function setProtocolTranslation($translateId, $protocolId)
    {
        if (in_array($translateId, $this->sysDefTransIds)) {
            $this->db->where('id', $translateId);
        } else {
            $this->db->where('for_user', USER_ID);
            $this->db->where('id', $translateId);
        }
        $result = $this->db->get('protocols_languages');
        $translate = $result->row_array();
        unset($translate['id']);
        unset($translate['for_user']);
        $translate['for_protocol'] = $protocolId;
        if (!$this->db->insert('protocols_translations', $translate)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function multipleDelete($ids)
    {
        if ($ids != null && is_array($ids)) {
            $this->db->where_in('id', $ids);
            $this->db->where('for_user', USER_ID);
            $this->db->where('for_company', SELECTED_COMPANY_ID);
            if (!$this->db->update('protocols', array('is_deleted' => 1))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function getProtocolByNumber($number)
    {
        $this->db->where('protocols.protocol_number', (int) $number);
        $this->db->where('protocols.for_user', USER_ID);
        $this->db->where('protocols.for_company', SELECTED_COMPANY_ID);
        $this->db->where('protocols.is_deleted', 0);
        $this->db->limit(1);
        $result = $this->db->get('protocols');
        $arr = $result->row_array();
        if (empty($arr)) {
            return $arr;
        }

        $result = $this->db->where('for_protocol', $arr['id'])->order_by('position', 'asc')->get('protocols_items');
        $items = $result->result_array();
        $arr['items'] = $items;

        $result = $this->db->where('for_protocol', $arr['id'])->get('protocols_clients');
        $client = $result->row_array();
        $arr['client'] = $client;

        $result = $this->db->where('for_protocol', $arr['id'])->get('protocols_firms');
        $firm = $result->row_array();
        $arr['firm'] = $firm;

        $result = $this->db->where('for_protocol', $arr['id'])->get('protocols_translations');
        $translation = $result->row_array();
        $arr['translation'] = $translation;
        return $arr;
    }

}
