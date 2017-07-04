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

    private $editId = 0;
    private $invNum = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('NewInvoiceModel', 'SettingsModel', 'ManagefirmsModel'));
    }

    public function index($invType = null, $invNum = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $data['currencies'] = $this->NewInvoiceModel->getCurrencies();
        $data['myDefaultFirmCurrency'] = $this->NewInvoiceModel->getFirmDefaultCurrency();
        $data['quantityTypes'] = $this->NewInvoiceModel->getAllQuantityTypes();
        $data['paymentMethods'] = $this->NewInvoiceModel->getPaymentMethods();
        $data['invoiceLanguages'] = $this->NewInvoiceModel->getMyInvoiceLanguages();
        $data['myNoVatReasons'] = $this->SettingsModel->getMyNoVatReasons();
        $data['nextInvNumber'] = $this->NewInvoiceModel->getNextFreeInvoiceNumber();
        if ($invNum > 0) {
            $this->invNum = $invNum;
            $inv_readable_types = array_flip($this->config->item('inv_readable_types'));
            $result = $this->NewInvoiceModel->getInvoiceByNumber($inv_readable_types[$invType], $invNum);
            if (empty($result)) {
                show_404();
            }
            $this->editId = $result['id'];
            $this->postChecker();
            $_POST = $result;
        } else {
            $this->postChecker();
        }
 
        $data['editId'] = $this->editId;
        if (isset($_POST['inv_currency'])) {
            $theCurrency = $_POST['inv_currency'];
        } elseif ($data['myDefaultFirmCurrency'] != null) {
            $theCurrency = $data['myDefaultFirmCurrency'];
        } else {
            $theCurrency = 'EUR';
        }
        $data['theCurrency'] = $theCurrency;
        $data['allForFirm'] = $this->ManagefirmsModel->getCompanyInfo(SELECTED_COMPANY_ID);
        $this->render('invoices/newinvoice', $head, $data);
        $this->saveHistory('Go to new invoice page');
    }

    private function postChecker()
    {
        if (isset($_POST['addNewInvoiceLanguage'])) {
            $this->addNewInvoiceLanguage();
        }
        /*
         * Add new invoice
         */
        if (isset($_POST['inv_type'])) {
            $_POST['editId'] = $this->editId; // Check is update or new invoice
            $this->createInvoice();
        }
    }

    private function createInvoice()
    {
        $isValid = $this->validateInvoice();
        $inv_readable_types = $this->config->item('inv_readable_types');
        if ($isValid === true) {
            if ($this->editId > 0) {
                $this->NewInvoiceModel->updateInvoice($_POST);
            } else {
                $_POST['userInfo'] = $this->userInfo; // get info for logged user
                $this->NewInvoiceModel->setInvoice($_POST);
            }
            redirect(lang_url('user/' . $inv_readable_types[$_POST['inv_type']] . '/view/' . $_POST['inv_number']));
        } else {
            $this->session->set_flashdata('resultAction', $isValid);
            if ($this->editId > 0) {
                redirect(lang_url('user/' . $inv_readable_types[$_POST['inv_type']] . '/edit/' . $this->invNum));
            } else {
                redirect(lang_url('user/new/invoice'));
            }
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
            $isFreeInvNum = $this->NewInvoiceModel->checkIsFreeInvoiceNumber($_POST['inv_number'], $_POST['inv_type'], $this->editId);
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

    public function modalselector()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        if (isset($_POST['selectType'])) {
            $result = $this->NewInvoiceModel->getListForSelector($_POST['selectType']);
            if (!empty($result)) {
                include 'application/modules/users/views/invoices/listSelectorHtml.php';
            } else {
                echo '<div class="no-data">' . $_POST['selectType'] == 'clients' ? lang('no_clients_selector') : lang('no_items_selector') . '</div>';
            }
        }
    }

}
