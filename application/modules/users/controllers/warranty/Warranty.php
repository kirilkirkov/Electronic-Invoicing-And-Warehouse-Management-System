<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Warranty extends USER_Controller
{

    private $num_rows = 20;
    private $editId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'WarrantyCardModel',
            'SettingsModel',
            'NewInvoiceModel',
            'ManagefirmsModel'
        ));
        $paginationNumRows = $this->SettingsModel->getValueStores('opt_pagination');
        $this->num_rows = $paginationNumRows;
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_warranties');
        $rowscount = $this->WarrantyCardModel->countWarranties($_GET);
        $data['warranties'] = $this->WarrantyCardModel->getWarranties($this->num_rows, $page, $_GET);
        $data['linksPagination'] = pagination('user/warranties', $rowscount, $this->num_rows, MY_DEFAULT_LANGUAGE_ABBR != MY_LANGUAGE_ABBR ? 4 : 3);
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                $this->deleteWarranties($_POST['ids']);
            }
        }
        $this->render('warranty/index', $head, $data);
        $this->saveHistory('Go to store page');
    }

    private function deleteWarranties($ids)
    {
        $this->WarrantyCardModel->multipleDeleteWarranties($ids);
        redirect(lang_url('user/warranties'));
    }

    public function addwarranty($number = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_add_warr');
        $data['myDefaultFirmCurrency'] = $this->NewInvoiceModel->getFirmDefaultCurrency();
        $data['nextWarrantyNumber'] = $this->WarrantyCardModel->getNextFreeWarrantyNumber();
        $data['warrantiesLanguages'] = $this->WarrantyCardModel->getMyWarrantiesLanguages();
        $data['allForFirm'] = $this->ManagefirmsModel->getCompanyInfo(SELECTED_COMPANY_ID);
        if ($data['myDefaultFirmCurrency'] != null) {
            $theCurrency = $data['myDefaultFirmCurrency'];
        } else {
            $theCurrency = 'EUR';
        }
        if (isset($_POST['addNewWarrantyTranslation'])) {
            $this->setNewWarrantyLanguage();
        }
        if (isset($_POST['warranty_number'])) {
            $this->createWarranty();
        }
        $currentItems = array();
        if ($number > 0) {
            $result = $this->WarrantyCardModel->getWarrantyByNumber($number);
            if (empty($result)) {
                log_message('error', 'User with id - ' . USER_ID . ' gets 404 when try to edit warranty with number - ' . $number);
                show_404();
            }
            $this->editId = $result['id'];
            foreach ($result['items'] as $item) {
                $currentItems[] = $item['id'];
            }
            $_POST = $result;
        }
        $data['currentItems'] = $currentItems;
        $data['editId'] = $this->editId;
        $data['theCurrency'] = $theCurrency;
        $data['myConditions'] = $this->WarrantyCardModel->getWarrantyConditions();
        $this->render('warranty/addwarranty', $head, $data);
        $this->saveHistory('Go to store page');
    }

    private function setNewWarrantyLanguage()
    {
        $this->WarrantyCardModel->setNewWarrantyLanguage($_POST);
        $this->saveHistory('Add warranty language - ' . $_POST['language_name']);
        redirect(lang_url('user/warranties/add-warranty'));
    }

    private function createWarranty()
    {
        $isValid = $this->validateWarranty();
        if ($isValid === true) {
            if ($_POST['editId'] > 0) {
                $this->WarrantyCardModel->updateWarranty($_POST);
                $this->session->set_flashdata('resultAction', lang('warranty_updated'));
            } else {
                $this->WarrantyCardModel->setWarranty($_POST);
                $this->session->set_flashdata('resultAction', lang('warranty_added'));
            }
            redirect(lang_url('user/warranties'));
        } else {
            $this->session->set_flashdata('resultAction', $isValid);
            redirect(lang_url('user/warranties/add-warranty'));
        }
        redirect(lang_url('user/warranties'));
    }

    private function validateWarranty()
    {
        $errors = array();
        if (mb_strlen(trim($_POST['warranty_number'])) == 0) {
            $errors[] = lang('err_create_war_num');
        } else {
            $isFreeNum = $this->WarrantyCardModel->checkIsFreeWarrantyNumber($_POST['warranty_number'], $_POST['editId']);
            if ($isFreeNum === false) {
                $errors[] = lang('err_create_war_num_is_taken');
            }
        }
        foreach ($_POST['items_names'] as $item_name) {
            if (mb_strlen(trim($item_name)) == 0) {
                $errors[] = lang('err_create_no_item_name');
            }
        }
        foreach ($_POST['items_months'] as $item_quantity) {
            if (mb_strlen(trim($item_quantity)) == 0) {
                $errors[] = lang('err_create_war_no_item_month');
            }
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

}
