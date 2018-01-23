<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Protocols extends USER_Controller
{

    private $num_rows = 20;
    private $editId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'ProtocolsModel',
            'NewInvoiceModel',
            'ManagefirmsModel',
            'SettingsModel'
        ));
        $paginationNumRows = $this->SettingsModel->getValueStores('opt_pagination');
        $this->num_rows = $paginationNumRows;
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_protocols');
        $rowscount = $this->ProtocolsModel->countProtocols($_GET);
        $data['protocols'] = $this->ProtocolsModel->getProtocols($this->num_rows, $page, $_GET);
        $data['linksPagination'] = pagination('user/protocols', $rowscount, $this->num_rows, MY_DEFAULT_LANGUAGE_ABBR != MY_LANGUAGE_ABBR ? 4 : 3);
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                $this->deleteProtocols($_POST['ids']);
            }
        }
        $this->render('protocols/index', $head, $data);
        $this->saveHistory('Go to protocol page');
    }

    private function deleteProtocols($ids)
    {
        $this->ProtocolsModel->multipleDelete($ids);
        redirect(lang_url('user/protocols'));
    }

    public function addProtocol($number = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_add_protocol');
        $data['prov_transmits'] = $this->ProtocolsModel->getProviderTransmits();
        $data['contracts'] = $this->ProtocolsModel->getContracts();
        $data['nextProtocolNumber'] = $this->ProtocolsModel->getNextFreeProtocolNumber();
        $data['currencies'] = $this->NewInvoiceModel->getCurrencies();
        $data['myDefaultFirmCurrency'] = $this->NewInvoiceModel->getFirmDefaultCurrency();
        $data['protocolsLanguages'] = $this->ProtocolsModel->getMyProtocolsLanguages();
        $data['allForFirm'] = $this->ManagefirmsModel->getCompanyInfo(SELECTED_COMPANY_ID);
        if ($data['myDefaultFirmCurrency'] != null) {
            $theCurrency = $data['myDefaultFirmCurrency'];
        } else {
            $theCurrency = 'EUR';
        }
        if (isset($_POST['addNewProtocolTranslation'])) {
            $this->setNewProtocolLanguage();
        }
        if (isset($_POST['protocol_number'])) {
            $this->createProtocol();
        }
        $currentItems = array();
        if ($number > 0) {
            $result = $this->ProtocolsModel->getProtocolByNumber($number);
            if (empty($result)) {
                log_message('error', 'User with id - ' . USER_ID . ' gets 404 when try to edit protocol with number - ' . $number);
                show_404();
            }
            $this->editId = $result['id'];

            foreach ($result['items'] as $item) {
                $currentItems[] = $item['id'];
            }
            $_POST = $result;
        }
        $data['currentItems'] = $currentItems;
        $data['updateId'] = $this->editId;
        $data['theCurrency'] = $theCurrency;
        $data['editId'] = $this->editId;
        $this->render('protocols/addprotocol', $head, $data);
        $this->saveHistory('Go to add protocol page');
    }

    private function setNewProtocolLanguage()
    {
        $this->ProtocolsModel->setNewProtocolLanguage($_POST);
        $this->saveHistory('Add protocol language - ' . $_POST['language_name']);
        redirect(lang_url('user/protocols/add-protocol'));
    }

    public function createProtocol()
    {
        $isValid = $this->validateProtocol();
        if ($isValid === true) {
            if ($_POST['editId'] > 0) {
                $this->ProtocolsModel->updateProtocol($_POST);
                $this->session->set_flashdata('resultAction', lang('protocol_updated'));
            } else {
                $this->ProtocolsModel->setProtocol($_POST);
                $this->session->set_flashdata('resultAction', lang('protocol_added'));
            }
            redirect(lang_url('user/protocols'));
        } else {
            $this->session->set_flashdata('resultAction', $isValid);
            redirect(lang_url('user/protocols/add-protocol'));
        }
        redirect(lang_url('user/protocols'));
    }

    private function validateProtocol()
    {
        $errors = array();
        if (mb_strlen(trim($_POST['protocol_number'])) == 0) {
            $errors[] = lang('err_create_prot_num');
        } else {
            $isFreeNum = $this->ProtocolsModel->checkIsFreeProtocolNumber($_POST['warranty_number'], $_POST['updateId']);
            if ($isFreeNum === false) {
                $errors[] = lang('err_create_prot_num_is_taken');
            }
        }
        foreach ($_POST['items_names'] as $item_name) {
            if (mb_strlen(trim($item_name)) == 0) {
                $errors[] = lang('err_create_no_item_name');
            }
        }
        foreach ($_POST['items_quantities'] as $item_quantity) {
            if (mb_strlen(trim($item_quantity)) == 0) {
                $errors[] = lang('err_create_prot_no_item_qa');
            }
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

}
