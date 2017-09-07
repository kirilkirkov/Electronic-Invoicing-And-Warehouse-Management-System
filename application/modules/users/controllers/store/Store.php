<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Store extends USER_Controller
{

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'StoreModel',
            'NewInvoiceModel',
            'SettingsModel',
            'ManagefirmsModel'
        ));
        $paginationNumRows = $this->SettingsModel->getValueStores('opt_pagination');
        $this->num_rows = $paginationNumRows;
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_movements');
        $data['myStores'] = $this->StoreModel->getStores();
        $rowscount = $this->StoreModel->countMovements($_GET);
        $data['movements'] = $this->StoreModel->getMovements($this->num_rows, $page, $_GET);
        $data['linksPagination'] = pagination('user/store', $rowscount, $this->num_rows, MY_DEFAULT_LANGUAGE_ABBR != MY_LANGUAGE_ABBR ? 4 : 3);
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'stat_canceled') {
                $this->changeStatusCanceled($_POST['ids'], true);
            }
            if ($_POST['action'] == 'remove_canceled') {
                $this->changeStatusCanceled($_POST['ids'], false);
            }
        }
        $this->render('store/index', $head, $data);
        $this->saveHistory('Go to store page');
    }

    private function changeStatusCanceled($ids, $toStatus)
    {
        $this->StoreModel->multipleStatusCanceledMovements($ids, $toStatus);
        redirect(lang_url('user/store'));
    }

    public function addMovement()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_add_movement');
        $data['myStores'] = $this->StoreModel->getStores();
        $data['currencies'] = $this->NewInvoiceModel->getCurrencies();
        $data['quantityTypes'] = $this->NewInvoiceModel->getAllQuantityTypes();
        $data['myDefaultFirmCurrency'] = $this->NewInvoiceModel->getFirmDefaultCurrency();
        $data['paymentMethods'] = $this->NewInvoiceModel->getPaymentMethods();
        $data['myNoVatReasons'] = $this->SettingsModel->getMyNoVatReasons();
        $data['movementsLanguages'] = $this->StoreModel->getMyMovementsLanguages();
        $data['allForFirm'] = $this->ManagefirmsModel->getCompanyInfo(SELECTED_COMPANY_ID);
        $data['nextMovementNumber'] = $this->StoreModel->getNextFreeMovementNumber();
        if ($data['myDefaultFirmCurrency'] != null) {
            $theCurrency = $data['myDefaultFirmCurrency'];
        } else {
            $theCurrency = 'EUR';
        }
        $data['theCurrency'] = $theCurrency;
        if (isset($_POST['type'])) {
            $this->createMovement();
        }
        if (isset($_POST['addNewMovementTranslation'])) {
            $this->setNewMovementLanguage();
        }

        $this->render('store/addmovement', $head, $data);
        $this->saveHistory('Go to store page');
    }

    private function setNewMovementLanguage()
    {
        $this->StoreModel->setNewMovementLanguage($_POST);
        $this->saveHistory('Add movement language - ' . $_POST['language_name']);
        redirect(lang_url('user/store/add-movement'));
    }

    private function createMovement()
    {
        $isValid = $this->validateMovement();
        if ($isValid === true) {
            $this->StoreModel->setMovement($_POST);
            $this->session->set_flashdata('resultAction', lang('movement_added'));
            redirect(lang_url('user/movement/view/' . $_POST['movement_number']));
        } else {
            $this->session->set_flashdata('resultAction', $isValid);
            redirect(lang_url('user/store/add-movement'));
        }
    }

    private function validateMovement()
    {
        $negativeQuantities = $this->SettingsModel->getValueStores('opt_negativeQuantities');

        $errors = array();
        if (mb_strlen(trim($_POST['movement_number'])) == 0) {
            $errors[] = lang('err_create_movem_num');
        } else {
            $isFreeNum = $this->StoreModel->checkIsFreeMovementNumber($_POST['movement_number']);
            if ($isFreeNum === false) {
                $errors[] = lang('err_create_movem_num_is_taken');
            }
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
        if ($_POST['type'] == 'out' || $_POST['type'] == 'move' || $_POST['type'] == 'revision') {
            $i = 0;
            foreach ($_POST['item_from_list'] as $item_from_list) {
                $haveEnoughtQuantity = $this->StoreModel->checkHaveEnoughtQuantity($_POST['selected_store'], $item_from_list);
                if ($haveEnoughtQuantity === null) {
                    $errors[] = str_replace('%item%', $_POST['items_names'][$i], lang('item_is_not_in_store'));
                } else {
                    if ($negativeQuantities == '0') {
                        if ($_POST['items_quantities'][$i] > $haveEnoughtQuantity) {
                            $errors[] = str_replace('%item%', $_POST['items_names'][$i], lang('item_no_enought_quantity'));
                        }
                    }
                }
                $i++;
            }
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

    public function stocks($page = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_stocks');
        $data['myStores'] = $this->StoreModel->getStores();
        $rowscount = $this->StoreModel->countStocks($this->num_rows, $page, $_GET);
        $data['stockQuantities'] = $this->StoreModel->getStockQuantities($this->num_rows, $page, $_GET);
        $data['linksPagination'] = pagination('user/store/stocks', $rowscount, $this->num_rows, MY_DEFAULT_LANGUAGE_ABBR != MY_LANGUAGE_ABBR ? 5 : 4);
        $this->render('store/stocks', $head, $data);
        $this->saveHistory('Go to store stocks');
    }

}
