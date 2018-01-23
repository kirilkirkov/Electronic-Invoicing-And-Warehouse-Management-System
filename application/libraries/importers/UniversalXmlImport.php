<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * UniversalXmlImport class
 */

class UniversalXmlImport
{

    private $CI;
    private $invoicesForImport = array();
    private $invReadableTypes;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->setInvTypes($this->CI->config->item('inv_readable_types'));
        $this->CI->load->model(array('NewInvoiceModel', 'ImportExportModel', 'ManagefirmsModel'));
    }

    private function setInvTypes($invReadableTypes)
    {
        $this->invReadableTypes = $invReadableTypes;
    }

    public function importFile($file)
    {
        $xmlobj = simplexml_load_file($file);
        if ($xmlobj === false) {
            $this->CI->session->set_flashdata('resultAction', lang('try_to_import_wrong_file_format'));
            redirect(lang_url('user/import-export'));
        }
        $this->parseObject($xmlobj);
        // Save Inoivces
        $this->CI->ImportExportModel->setInvoicesFromImport($this->invoicesForImport);
        // Return to view
        return $this->invoicesForImport;
    }

    private function parseObject($xmlobj)
    {
        $invTypesKeys = array_flip($this->invReadableTypes);

        $errors = array();
        // check for head note
        if (!isset($xmlobj->invoice)) {
            $this->CI->session->set_flashdata('resultAction', lang('no_invoice_note_in_xml_import'));
            redirect(lang_url('user/import-export'));
        }

        /*
         * Lets parse
         * And check for errоrs
         */
        $row = 1;
        foreach ($xmlobj->invoice as $invoice) {
            $errors = array();
            $inv = array();

            if (!in_array($invoice->type, $this->invReadableTypes)) {
                $errors[] = lang('imp_invalid_inv_type');
            }

            $isFreeNumber = $this->CI->NewInvoiceModel->checkIsFreeInvoiceNumber((string) $invoice->number, $invTypesKeys[(string) $invoice->type]);
            if ($isFreeNumber === false) {
                $errors[] = lang('imp_inv_number_taken');
            }

            if (!isset($invoice->created) || strtotime(date('d.m.Y', (string) $invoice->created)) == false) {
                $errors[] = lang('imp_wrong_date_created');
            }


            if (!isset($invoice->tax_event_date) || strtotime(date('d.m.Y', (string) $invoice->tax_event_date)) == false) {
                $errors[] = lang('imp_wrong_date_tax_event');
            }

            if (!isset($invoice->have_maturity_date) || $invoice->have_maturity_date == 1) {
                if (!isset($invoice->maturity_date) || strtotime(date('d.m.Y', (string) $invoice->maturity_date)) == false) {
                    $errors[] = lang('imp_wrong_date_maturity');
                }
            }

            if ($invTypesKeys[(string) $invoice->type] == 'debit' || $invTypesKeys[(string) $invoice->type] == 'credit') {
                if (!isset($invoice->to_inv_date) || strtotime(date('d.m.Y', (string) $invoice->to_inv_date)) == false) {
                    $errors[] = lang('imp_to_inv_date_wrong');
                }
            }

            if (!isset($invoice->client->name) || mb_strlen((string) $invoice->client->name) == 0) {
                $errors[] = lang('imp_no_client_name');
            }

            if (!isset($invoice->client->client_address) || mb_strlen((string) $invoice->client->client_address) == 0) {
                $errors[] = lang('imp_no_client_addr');
            }

            if (!isset($invoice->items->item)) {
                $errors[] = lang('imp_no_items');
            } else {
                $rowItem = 1;
                foreach ($invoice->items->item as $item) {
                    if (mb_strlen((string) $item->name) == 0) {
                        $errors[] = str_replace('%rowNum%', $rowItem, lang('imp_no_item_name'));
                    }
                    if ((float) $item->quantity == 0 || mb_strlen((string) $item->quantity) == 0) {
                        $errors[] = str_replace('%rowNum%', $rowItem, lang('imp_no_item_quantity'));
                    }
                    $rowItem ++;
                }
            }

            /*
             * Error checks finish
             * Now Push all to inv array
             */
            $inv['inv_type'] = $invTypesKeys[(string) $invoice->type];
            $inv['status'] = (string) $invoice->status;
            $inv['inv_number'] = (string) $invoice->number;
            $inv['inv_currency'] = (string) $invoice->currency;
            $inv['created'] = (string) $invoice->created;
            $inv['tax_event_date'] = (string) $invoice->tax_event_date;
            $inv['cash_accounting'] = (int) $invoice->cash_accounting == 1 ? 1 : 0;
            $inv['have_maturity_date'] = (int) $invoice->have_maturity_date == 1 ? 1 : 0;
            $inv['maturity_date'] = (string) $invoice->maturity_date;
            $inv['remarks'] = (string) $invoice->remarks;
            $inv['payment_method'] = (string) $invoice->payment_method;
            $inv['payment_status'] = (string) $invoice->payment_status;
            $inv['to_inv_number'] = (int) $invoice->to_inv_number;
            $inv['to_inv_date'] = (int) $invoice->to_inv_date;
            $inv['invoice_amount'] = (float) $invoice->invoice_amount;
            $inv['discount'] = (float) $invoice->discount;
            $inv['discount_type'] = (string) $invoice->discount_type;
            $inv['tax_base'] = (float) $invoice->tax_base;
            $inv['vat_percent'] = (float) $invoice->vat_percent;
            $inv['vat_sum'] = (float) $invoice->vat_sum;
            $inv['no_vat'] = (int) $invoice->no_vat == 1 ? 1 : 0;
            $inv['no_vat_reason'] = (string) $invoice->no_vat_reason;
            $inv['final_total'] = (float) $invoice->final_total;
            $inv['userInfo']['employee']['name'] = 'aasd';
            $inv['userInfo']['employee']['schiffer'] = (string) $invoice->schiffer;
            $inv['client_name'] = (string) $invoice->client->name;
            $inv['is_person'] = (int) $invoice->client->is_person == 1 ? 1 : 0;
            $inv['client_bulstat'] = (string) $invoice->client->bulstat;
            $inv['client_vat_registered'] = (int) $invoice->client->is_client_vat_registered == 1 ? 1 : 0;
            $inv['vat_number'] = (string) $invoice->client->vat_number;
            $inv['client_ident_num'] = (string) $invoice->client->client_ident_num;
            $inv['client_address'] = (string) $invoice->client->client_address;
            $inv['client_city'] = (string) $invoice->client->client_city;
            $inv['client_country'] = (string) $invoice->client->client_country;
            $inv['accountable_person'] = (string) $invoice->client->accountable_person;
            $inv['recipient_name'] = (string) $invoice->client->recipient_name;
            $rowTrans = $this->CI->ManagefirmsModel->getMyCompanyDefaultTranslation(SELECTED_COMPANY_ID);
            $inv['invoice_firm_translation'] = $rowTrans['id'];
            $inv['invoice_translation'] = (int) $invoice->inv_lang;

            if (isset($invoice->items->item)) {
                $i = 0;
                $ii = 1;
                foreach ($invoice->items->item as $item) {
                    $inv['item_from_list'][$i] = $ii;
                    $inv['is_item_update'][$i] = 0;
                    $inv['items_names'][$i] = (string) $item->name;
                    $inv['items_quantities'][$i] = (float) $item->quantity;
                    $inv['items_quantity_types'][$i] = (string) $item->quantity_type;
                    $inv['items_prices'][$i] = (float) $item->single_price;
                    $inv['items_totals'][$i] = (float) $item->total_price;
                    $i++;
                    $ii++;
                }
            }
            $this->invoicesForImport[$row]['inv'] = $inv;
            $this->invoicesForImport[$row]['errors'] = $errors;
            $row ++;
        }
    }

}
