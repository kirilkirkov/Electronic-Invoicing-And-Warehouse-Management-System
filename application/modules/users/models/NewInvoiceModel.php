<?php

class NewInvoiceModel extends CI_Model
{

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

    public function updateInvoicesRoundTo($roundTo)
    {
        $this->db->limit(1);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('users_invoices_options', array('opt_inv_roundTo' => $roundTo))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setNewInvoiceLanguage($post)
    {
        unset($post['addNewTranslation']);
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

    public function checkIsFreeInvoiceNumber($number)
    {
        $this->db->where('inv_number', $number);
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
        $result = $this->db->get('invoices');
        $row = $result->row_array();
        /*
         * If dont have invoices return number 1
         * Else the max number + 1
         */
        if (empty($row)) {
            return full_inv_number(1);
        } else {
            return full_inv_number($row['inv_number'] + 1);
        }
    }

    public function setInvoice($post)
    {
        $cashAccounting = isset($post['cash_accounting']) ? 1 : 0;
        $cash_accounting = isset($post['cash_accounting']) ? 1 : 0;
        $client_vat_registered = isset($post['client_vat_registered']) ? 1 : 0;
        $have_maturity_date = isset($post['have_maturity_date']) ? 1 : 0;
        $no_vat = isset($post['no_vat']) ? 1 : 0;
        $insertArray = array(
            'for_user' => USER_ID,
            'for_company' => SELECTED_COMPANY_ID,
            'inv_type' => $post['inv_type'],
            'inv_number' => $post['inv_number'],
            'inv_currency' => $post['inv_currency'],
            'date_create' => strtotime($post['date_create']),
            'date_tax_event' => strtotime($post['date_tax_event']),
            'cash_accounting' => $cash_accounting,
            'have_maturity_date' => $have_maturity_date,
            'maturity_date' => strtotime($post['maturity_date']),
            'remarks' => $post['remarks'],
            'payment_method' => $post['payment_method'],
            'to_inv_number' => $post['to_inv_number'],
            'to_inv_date' => $post['to_inv_date'],
            'client_vat_registered' => $client_vat_registered,
            'invoice_amount' => $post['invoice_amount'],
            'discount' => $post['discount'],
            'discount_type' => $post['discount_type'],
            'tax_base' => $post['tax_base'],
            'vat_percent' => $post['vat_percent'],
            'vat_sum' => $post['vat_sum'],
            'no_vat' => $no_vat,
            'no_vat_reason' => $post['no_vat_reason'],
            'final_total' => $post['final_total']
        );
        if (!$this->db->insert('invoices', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
        $insertId = $this->db->insert_id();
        $this->setInvoiceTranslation($insertId, $post['invoice_translation']);
        $this->setInvoiceItems($insertId, $post);
        $this->setInvoiceClient($insertId, $post);
    }

    private function setInvoiceClient($invoiceId, $post)
    {
        $is_to_person = isset($post['is_to_person']) ? 1 : 0;
        $insertArray = array(
            'for_invoice' => $invoiceId,
            'for_user' => USER_ID,
            'for_company' => SELECTED_COMPANY_ID,
            'client_name' => $post['client_name'],
            'client_bulstat' => $post['client_bulstat'],
            'is_to_person' => $is_to_person,
            'client_ident_num' => $post['client_ident_num'],
            'client_address' => $post['client_address'],
            'client_city' => $post['client_city'],
            'client_country' => $post['client_country'],
            'recipient_name' => $post['recipient_name'],
        );
        if (!$this->db->insert('invoices_clients', $insertArray)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    private function setInvoiceTranslation($invoiceId, $translateId)
    {
        if ($translateId == '0') {
            $this->db->where('id', 1);
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
            show_error(lang('database_error'));
        }
    }

    private function setInvoiceItems($invoiceId, $post)
    {
        $numItems = count($post['items_names']) - 1;
        $i = 0;
        $position = 1;
        while ($i <= $numItems) {
            if (!$this->db->insert('invoices_items', array(
                        'for_invoice' => $invoiceId,
                        'for_user' => USER_ID,
                        'for_company' => SELECTED_COMPANY_ID,
                        'name' => $post['items_names'][$i],
                        'quantity' => $post['items_quantities'][$i],
                        'quantity_type' => $post['items_quantity_types'][$i],
                        'single_price' => $post['items_prices'][$i],
                        'total_price' => $post['items_totals'][$i],
                        'position' => $position
                    ))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            $i++;
            $position++;
        }
    }

}
