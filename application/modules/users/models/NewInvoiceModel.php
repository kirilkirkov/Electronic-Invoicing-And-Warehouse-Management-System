<?php

class NewInvoiceModel extends CI_Model
{
    /*
     * Ids in database of the default 
     * invoice languages in table "invoices_languages"
     * JUST HARDCODED $sysDefTransIds
     * They must be same in $sysDefTransIds, newinvoice.php(view) and in "invoices_languages" table
     */

    private $sysDefTransIds = array(1, 2, 3);

    public function __construct()
    {
        parent::__construct();
    }

    public function getCurrencies()
    {
        $result = $this->db->query('SELECT name, value FROM currencies UNION ALL SELECT name, value FROM users_currencies WHERE users_currencies.for_user = ' . $this->db->escape(USER_ID));
        return $result->result_array();
    }

    public function getFirmDefaultCurrency()
    {
        $this->db->select('default_currency');
        $this->db->where('id', SELECTED_COMPANY_ID);
        $result = $this->db->get('firms_users');
        $ar = $result->row_array();
        return $ar['default_currency'];
    }

    public function getAllQuantityTypes()
    {
        $result = $this->db->query('SELECT name FROM quantity_types UNION ALL SELECT name FROM users_quantity_types WHERE users_quantity_types.for_user = ' . $this->db->escape(USER_ID));
        return $result->result_array();
    }

    public function setNewCustomQuantityType($newQuantityType)
    {
        if (!$this->db->insert('users_quantity_types', array('name' => $newQuantityType, 'for_user' => USER_ID))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getPaymentMethods()
    {
        $result = $this->db->query('SELECT name FROM payment_methods UNION ALL SELECT name FROM users_payment_methods WHERE users_payment_methods.for_user = ' . $this->db->escape(USER_ID));
        return $result->result_array();
    }

    public function setNewCustomPaymentMethod($newPaymentMethod)
    {
        if (!$this->db->insert('users_payment_methods', array('name' => $newPaymentMethod, 'for_user' => USER_ID))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setNewVatReason($newVatReason)
    {
        if (!$this->db->insert('user_no_vat_reasons', array('reason' => $newVatReason, 'for_user' => USER_ID))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setNewInvoiceLanguage($post)
    {
        unset($post['addNewInvoiceLanguage']);
        $post['for_user'] = USER_ID;
        if (!$this->db->insert('invoices_languages', $post)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyInvoiceLanguages()
    {
        $this->db->select('id, language_name');
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('invoices_languages');
        return $result->result_array();
    }

    public function checkIsFreeInvoiceNumber($number, $invType, $without = 0)
    {
        /*
         * If we edit an invoice, 
         * we put the ID to not be verified
         */
        if ($without > 0) {
            $this->db->where('id !=', $without);
        }
        $this->db->where('inv_type', $invType);
        $this->db->where('inv_number', $number);
        $this->db->where('is_deleted', 0);
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $num = $this->db->count_all_results('invoices');
        if ($num > 0) {
            return false;
        }
        return true;
    }

    public function getNextFreeInvoiceNumber()
    {
        $this->db->select_max('inv_number');
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        $this->db->where('is_deleted', 0);
        $result = $this->db->get('invoices');
        $row = $result->row_array();
        /*
         * If dont have invoices return number 1
         * Else the max number + 1
         */
        if (empty($row)) {
            return full_document_number(1);
        } else {
            return full_document_number($row['inv_number'] + 1);
        }
    }

    public function setInvoice($post)
    {
        $inv_statuses = $this->config->item('inv_statuses');
        $cash_accounting = isset($post['cash_accounting']) ? 1 : 0;
        $have_maturity_date = isset($post['have_maturity_date']) ? 1 : 0;
        $no_vat = isset($post['no_vat']) ? 1 : 0;
        $composedFrom = isset($post['userInfo']['employee']) ? $post['userInfo']['employee']['name'] : $post['userInfo']['user']['name'];
        $schiffer = isset($post['userInfo']['employee']) ? $post['userInfo']['employee']['schiffer'] : $post['userInfo']['user']['schiffer'];
        $insertArray = array(
            'for_user' => USER_ID,
            'for_company' => SELECTED_COMPANY_ID,
            'inv_type' => htmlspecialchars(trim($post['inv_type'])),
            'status' => !in_array($post['status'], $inv_statuses) ? 'issued' : $post['status'],
            'inv_number' => full_document_number(htmlspecialchars(trim($post['inv_number']))),
            'inv_currency' => htmlspecialchars(trim($post['inv_currency'])),
            'date_create' => strtotime($post['date_create']),
            'date_tax_event' => strtotime($post['date_tax_event']),
            'cash_accounting' => $cash_accounting,
            'have_maturity_date' => $have_maturity_date,
            'maturity_date' => strtotime($post['maturity_date']),
            'remarks' => htmlspecialchars(trim($post['remarks'])),
            'payment_method' => htmlspecialchars(trim($post['payment_method'])),
            'payment_status' => 'unpaid',
            'to_inv_number' => htmlspecialchars(trim($post['to_inv_number'])),
            'to_inv_date' => strtotime($post['to_inv_date']),
            'invoice_amount' => htmlspecialchars(trim($post['invoice_amount'])),
            'discount' => htmlspecialchars(trim($post['discount'])),
            'discount_type' => htmlspecialchars(trim($post['discount_type'])),
            'tax_base' => htmlspecialchars(trim($post['tax_base'])),
            'vat_percent' => htmlspecialchars(trim($post['vat_percent'])),
            'vat_sum' => htmlspecialchars(trim($post['vat_sum'])),
            'no_vat' => $no_vat,
            'no_vat_reason' => htmlspecialchars(trim($post['no_vat_reason'])),
            'final_total' => htmlspecialchars(trim($post['final_total'])),
            'composed' => htmlspecialchars(trim($composedFrom)),
            'schiffer' => htmlspecialchars(trim($schiffer)),
            'created' => time(),
            'uniqid' => USER_ID . 'u' . uniqid()
        );
        $this->db->trans_begin();
        if (!$this->db->insert('invoices', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
        $insertId = $this->db->insert_id();
        $this->setInvoiceTranslation($insertId, $post['invoice_translation']);
        $this->setInvoiceItems($insertId, $post);
        $this->setInvoiceClient($insertId, $post);
        $this->setInvoiceFirm($insertId, $post);
        $this->removeInvoiceNumberFromPlans(); // decrement invoices number from plans
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function updateInvoice($post)
    {
        $cash_accounting = isset($post['cash_accounting']) ? 1 : 0;
        $have_maturity_date = isset($post['have_maturity_date']) ? 1 : 0;
        $no_vat = isset($post['no_vat']) ? 1 : 0;
        $updateArray = array(
            'inv_type' => htmlspecialchars($post['inv_type']),
            'inv_number' => htmlspecialchars($post['inv_number']),
            'inv_currency' => htmlspecialchars($post['inv_currency']),
            'date_create' => strtotime($post['date_create']),
            'date_tax_event' => strtotime($post['date_tax_event']),
            'cash_accounting' => $cash_accounting,
            'have_maturity_date' => $have_maturity_date,
            'maturity_date' => strtotime($post['maturity_date']),
            'remarks' => htmlspecialchars($post['remarks']),
            'payment_method' => htmlspecialchars($post['payment_method']),
            'to_inv_number' => htmlspecialchars($post['to_inv_number']),
            'to_inv_date' => strtotime($post['to_inv_date']),
            'invoice_amount' => htmlspecialchars($post['invoice_amount']),
            'discount' => htmlspecialchars($post['discount']),
            'discount_type' => htmlspecialchars($post['discount_type']),
            'tax_base' => htmlspecialchars($post['tax_base']),
            'vat_percent' => htmlspecialchars($post['vat_percent']),
            'vat_sum' => htmlspecialchars($post['vat_sum']),
            'no_vat' => $no_vat,
            'no_vat_reason' => htmlspecialchars($post['no_vat_reason']),
            'composed' => htmlspecialchars($post['composed']),
            'schiffer' => htmlspecialchars($post['schiffer']),
            'final_total' => htmlspecialchars($post['final_total'])
        );
        $this->db->trans_begin();
        if (!$this->db->where('id', $post['editId'])->update('invoices', $updateArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
        if (isset($post['show_translations'])) {
            $this->updateInvoiceTranslation($post['editId'], $post['invoice_translation']);
        }
        $this->updateInvoiceClient($post['editId'], $post);
        $this->updateInvoiceItems($post['editId'], $post);
        if (isset($post['show_translations_firms'])) {
            $this->updateInvoiceFirm($post['editId'], $post);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    private function setInvoiceFirm($invoiceId, $post)
    {
        $this->db->where('firms_translations.id', $post['invoice_firm_translation']);
        $this->db->where('firms_users.for_user', USER_ID);
        $this->db->where('firms_users.id', SELECTED_COMPANY_ID);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        $firm = $result->row_array();

        $insertArray = array(
            'for_invoice' => $invoiceId,
            'for_user' => USER_ID,
            'bulstat' => $firm['bulstat'],
            'name' => $firm['name'],
            'address' => $firm['address'],
            'city' => $firm['city'],
            'accountable_person' => $firm['mol'],
            'is_vat_registered' => $firm['is_vat_registered'],
            'vat_number' => $firm['vat_number'],
            'image' => $firm['image'] == null ? '' : $firm['image']
        );
        if (!$this->db->insert('invoices_firms', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function removeInvoiceNumberFromPlans()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('from_date <=', time());
        $this->db->where('to_date >=', time());
        $this->db->where('num_invoices >', 0);
        $this->db->order_by('to_date', 'ASC');
        $this->db->limit(1);
        $this->db->set('num_invoices', 'num_invoices - 1', FALSE);
        if (!$this->db->update('firms_plans')) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function updateInvoiceFirm($invoiceId, $post)
    {
        $this->db->where('firms_translations.id', $post['invoice_firm_translation']);
        $this->db->where('firms_users.for_user', USER_ID);
        $this->db->where('firms_users.id', SELECTED_COMPANY_ID);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        $firm = $result->row_array();

        $updateArray = array(
            'bulstat' => $firm['bulstat'],
            'name' => $firm['name'],
            'address' => $firm['address'],
            'city' => $firm['city'],
            'accountable_person' => $firm['mol'],
            'is_vat_registered' => $firm['is_vat_registered'],
            'vat_number' => $firm['vat_number'],
            'image' => $firm['image']
        );
        if (!$this->db->where('for_invoice', $invoiceId)->update('invoices_firms', $updateArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function updateInvoiceTranslation($invoiceId, $translateId)
    {
        if (in_array($translateId, $this->sysDefTransIds)) {
            $this->db->where('id', $translateId);
        } else {
            $this->db->where('for_user', USER_ID);
            $this->db->where('id', $translateId);
        }
        $result = $this->db->get('invoices_languages');
        $translate = $result->row_array();
        unset($translate['id']);
        $translate['for_invoice'] = $invoiceId;
        $translate['for_user'] = USER_ID;
        $this->db->where('for_invoice', $invoiceId);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('invoices_translations', $translate)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function updateInvoiceClient($invoiceId, $post)
    {
        $is_to_person = isset($post['is_to_person']) ? 1 : 0;
        $client_vat_registered = isset($post['client_vat_registered']) ? 1 : 0;
        $updateArray = array(
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
            'recipient_name' => htmlspecialchars(trim($post['recipient_name'])),
        );
        if (!$this->db->where('for_invoice', $invoiceId)->update('invoices_clients', $updateArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    private function updateInvoiceItems($invoiceId, $post)
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
            $this->db->where('for_invoice', $invoiceId);
            $this->db->where_in('id', $deleteIds);
            if (!$this->db->delete('invoices_items')) {
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
                if (!$this->db->where('for_invoice', $invoiceId)->where('id', $post['is_item_update'][$i])->update('invoices_items', $arrItem)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            } else {
                $arrItem = array(
                    'for_invoice' => $invoiceId,
                    'for_user' => USER_ID,
                    'for_company' => SELECTED_COMPANY_ID,
                    'name' => htmlspecialchars(trim($post['items_names'][$i])),
                    'quantity' => htmlspecialchars(trim($post['items_quantities'][$i])),
                    'quantity_type' => htmlspecialchars(trim($post['items_quantity_types'][$i])),
                    'single_price' => htmlspecialchars(trim($post['items_prices'][$i])),
                    'total_price' => htmlspecialchars(trim($post['items_totals'][$i])),
                    'position' => $position
                );
                if (!$this->db->insert('invoices_items', $arrItem)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            $i++;
            $position++;
        }
    }

    private function setInvoiceClient($invoiceId, $post)
    {
        $is_to_person = isset($post['is_to_person']) ? 1 : 0;
        $client_vat_registered = isset($post['client_vat_registered']) ? 1 : 0;
        $insertArray = array(
            'for_invoice' => $invoiceId,
            'for_user' => USER_ID,
            'for_company' => SELECTED_COMPANY_ID,
            'client_name' => htmlspecialchars(trim($post['client_name'])),
            'client_bulstat' => htmlspecialchars(trim($post['client_bulstat'])),
            'is_to_person' => $is_to_person,
            'client_vat_registered' => $client_vat_registered,
            'vat_number' => htmlspecialchars(trim($post['vat_number'])),
            'client_ident_num' => htmlspecialchars(trim($post['client_ident_num'])),
            'client_address' => htmlspecialchars($post['client_address']),
            'client_city' => htmlspecialchars(trim($post['client_city'])),
            'client_country' => htmlspecialchars(trim($post['client_country'])),
            'accountable_person' => htmlspecialchars(trim($post['accountable_person'])),
            'recipient_name' => htmlspecialchars(trim($post['recipient_name'])),
        );
        if (!$this->db->insert('invoices_clients', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
        }
        /*
         * If client is not selected from list
         * add it 
         */
        if ($post['client_from_list'] == 0) {
            $this->setClient($post);
        }
    }

    private function setInvoiceItems($invoiceId, $post)
    {
        $numItems = count($post['items_names']) - 1;
        $i = 0;
        $position = 1;
        while ($i <= $numItems) {
            $arrItem = array(
                'for_invoice' => $invoiceId,
                'for_user' => USER_ID,
                'for_company' => SELECTED_COMPANY_ID,
                'name' => htmlspecialchars(trim($post['items_names'][$i])),
                'quantity' => htmlspecialchars(trim($post['items_quantities'][$i])),
                'quantity_type' => htmlspecialchars(trim($post['items_quantity_types'][$i])),
                'single_price' => htmlspecialchars(trim($post['items_prices'][$i])),
                'total_price' => htmlspecialchars(trim($post['items_totals'][$i])),
                'position' => $position
            );
            if (!$this->db->insert('invoices_items', $arrItem)) {
                log_message('error', print_r($this->db->error(), true));
            }
            /*
             * If item is not selected from list
             * add it 
             */
            if ($post['item_from_list'][$i] == 0) {
                unset($arrItem['position'], $arrItem['total_price'], $arrItem['for_invoice'], $arrItem['quantity']);
                $arrItem['currency'] = $post['inv_currency'];
                $this->setItemFromInvoice($arrItem);
            }
            $i++;
            $position++;
        }
    }

    private function setInvoiceTranslation($invoiceId, $translateId)
    {
        if (in_array($translateId, $this->sysDefTransIds)) {
            $this->db->where('id', $translateId);
        } else {
            $this->db->where('for_user', USER_ID);
            $this->db->where('id', $translateId);
        }
        $result = $this->db->get('invoices_languages');
        $translate = $result->row_array();
        unset($translate['id']);
        $translate['for_invoice'] = $invoiceId;
        $translate['for_user'] = USER_ID;
        if (!$this->db->insert('invoices_translations', $translate)) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function setClient($post)
    {
        $is_to_person = isset($post['is_to_person']) ? 1 : 0;
        $client_vat_registered = isset($post['client_vat_registered']) ? 1 : 0;
        $insertArray = array(
            'for_user' => USER_ID,
            'for_company' => SELECTED_COMPANY_ID,
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
            'recipient_name' => htmlspecialchars(trim($post['recipient_name'])),
        );
        if ($post['editId'] > 0) {
            if (!$this->db->where('id', $post['editId'])->update('clients', $insertArray)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            if (!$this->db->insert('clients', $insertArray)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            return $this->db->insert_id();
        }
    }

    public function setItemFromInvoice($arrItem)
    {
        if (!$this->db->insert('items', $arrItem)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getListForSelector($type)
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('for_company', SELECTED_COMPANY_ID);
        if ($type == 'client') {
            $this->db->select('client_name, client_bulstat, is_to_person, vat_number, client_vat_registered, client_ident_num, client_address, client_city, client_country, accountable_person, recipient_name');
            $result = $this->db->get('clients');
        }
        if ($type == 'item') {
            $this->db->select('id, name, quantity_type, single_price, currency');
            $result = $this->db->get('items');
        }
        return $result->result_array();
    }

    public function getInvoiceByNumber($invType, $invId)
    {
        $this->db->where('inv_type', $invType);
        $this->db->where('invoices.inv_number', $invId);
        $this->db->where('invoices.for_user', USER_ID);
        $this->db->where('invoices.for_company', SELECTED_COMPANY_ID);
        $this->db->where('invoices.is_deleted', 0);
        $this->db->limit(1);
        $result = $this->db->get('invoices');
        $arr = $result->row_array();
// if dont find this invoice.. dont search items
        if (empty($arr)) {
            return $arr;
        }
        $result = $this->db->where('for_invoice', $arr['id'])->order_by('position', 'asc')->get('invoices_items');
        $items = $result->result_array();
        $arr['items'] = $items;

        $result = $this->db->where('for_invoice', $arr['id'])->get('invoices_clients');
        $client = $result->row_array();
        $arr['client'] = $client;

        $result = $this->db->where('for_invoice', $arr['id'])->get('invoices_firms');
        $firm = $result->row_array();
        $arr['firm'] = $firm;

        $result = $this->db->where('for_invoice', $arr['id'])->get('invoices_translations');
        $translation = $result->row_array();
        $arr['translation'] = $translation;
        return $arr;
    }

    public function getActionHistory($invoiceId)
    {
        $this->db->where('invoice_id', $invoiceId);
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('invoices_logs');
        return $result->result_array();
    }

}
