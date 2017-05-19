<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Newinvoice extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('NewInvoiceModel');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $this->postChecker();
        $head['title'] = 'Administration - Home';
        $data['currencies'] = $this->NewInvoiceModel->getCurrencies();
        $data['myDefaultFirmCurrency'] = $this->NewInvoiceModel->getFirmDefaultCurrency();
        $data['quantityTypes'] = $this->NewInvoiceModel->getAllQuantityTypes();
        $data['paymentMethods'] = $this->NewInvoiceModel->getPaymentMethods();
        $data['invoiceLanguages'] = $this->NewInvoiceModel->getMyInvoiceLanguages();
        $nextInvNumber = $this->NewInvoiceModel->getNextFreeInvoiceNumber();
        $data['nextInvNumber'] = $nextInvNumber;
        $this->render('newinvoice/index', $head, $data);
        $this->saveHistory('Go to new invoice page');
    }

    private function postChecker()
    {
        if (isset($_POST['addNewInvoiceLanguage'])) {
            $this->addNewInvoiceLanguage();
        }
        if (isset($_POST['inv_type'])) {
            $this->createInvoice();
        }
    }

    private function createInvoice()
    {
        $isValid = $this->validateInvoice();
        if ($isValid === true) {
            $this->NewInvoiceModel->setInvoice($_POST);
            redirect(lang_url('user/new/invoice'));
        } else {
            $this->session->set_flashdata('resultAction', $isValid);
            redirect(lang_url('user/new/invoice'));
        }
    }

    private function validateInvoice()
    {
        $errors = array();
        if ($_POST['inv_type'] == 'debit' || $_POST['inv_type'] == 'credit') {
            if (mb_strlen(trim($_POST['to_inv_number'])) == 0) {
                $errors[] = lang('err_create_to_inv_num');
            }
            if (mb_strlen(trim($_POST['to_inv_date'])) == 0) {
                $errors[] = lang('err_create_to_inv_date');
            }
        }
        if (mb_strlen(trim($_POST['client_name'])) == 0) {
            $errors[] = lang('err_create_client_name');
        }
        if (mb_strlen(trim($_POST['client_address'])) == 0) {
            $errors[] = lang('err_create_client_addr');
        }
        if (mb_strlen(trim($_POST['inv_number'])) == 0) {
            $errors[] = lang('err_create_inv_num');
        } else {
            $isFreeInvNum = $this->NewInvoiceModel->checkIsFreeInvoiceNumber($_POST['inv_number']);
            if ($isFreeInvNum === false) {
                $errors[] = lang('err_create_inv_num_is_taken');
            }
        }
        if (mb_strlen(trim($_POST['date_create'])) == 0) {
            $errors[] = lang('err_create_date_create');
        }
        if (mb_strlen(trim($_POST['date_tax_event'])) == 0) {
            $errors[] = lang('err_create_tax_event');
        }
        foreach ($_POST['items_names'] as $item_name) {
            if (mb_strlen(trim($item_name)) == 0) {
                $errors[] = lang('err_create_no_item_name');
            }
        }
        foreach ($_POST['items_quantities'] as $item_quantity) {
            if (mb_strlen(trim($item_quantity)) == 0) {
                $errors[] = lang('err_create_no_item_qua');
            }
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

    private function addNewInvoiceLanguage()
    {
        $this->NewInvoiceModel->setNewInvoiceLanguage($_POST);
        $this->saveHistory('Add invoice translation - ' . $_POST['language_name']);
        redirect(lang_url('user/new/invoice'));
    }

    public function addnewquantitytype()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        if (isset($_POST['newVal'])) {
            $this->NewInvoiceModel->setNewCustomQuantityType($_POST['newVal']);
        }
    }

    public function addnewpaymentmethod()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        if (isset($_POST['newVal'])) {
            $this->NewInvoiceModel->setNewCustomPaymentMethod($_POST['newVal']);
        }
    }

}
