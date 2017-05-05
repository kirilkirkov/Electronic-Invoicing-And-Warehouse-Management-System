<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Invoices extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('SettingsModel', 'NewInvoiceModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        if (isset($_POST['currencyName'])) {
            $this->addCurrency();
        }
        if (isset($_POST['quantityTypeName'])) {
            $this->addQuantityType();
        }
        $head['title'] = 'Administration - Settings Invoices';
        $data['myFirms'] = $this->SettingsModel->getMyFirmsDefaultCurrency();
        $data['currencies'] = $this->NewInvoiceModel->getCurrencies();
        $data['myCurrencies'] = $this->SettingsModel->getMyCurrencies();
        $data['myQuantityTypes'] = $this->SettingsModel->getMyQuantityTypes();
        $this->render('settings/invoices', $head, $data);
        $this->saveHistory('Go to settings invoices page');
    }

    private function addCurrency()
    {
        $this->SettingsModel->setNewCurrency($_POST);
        $this->saveHistory('Add new currency - ' . $_POST['currencyName'] . ' - ' . $_POST['currencyValue']);
        redirect(lang_url('user/settings/invoices'));
    }

    private function addQuantityType()
    {
        $this->NewInvoiceModel->setNewCustomQuantityType($_POST['quantityTypeName']);
        $this->saveHistory('Add new quantity type - ' . $_POST['quantityTypeName']);
        redirect(lang_url('user/settings/invoices'));
    }

    /*
     * Called from ajax only
     */

    public function defaultcurrency()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        if ((isset($_POST['forId']) && is_numeric($_POST['forId'])) && isset($_POST['newDefault'])) {
            $result = $this->SettingsModel->setNewDefaultCurrency($_POST);
            if ($result == true) {
                echo '1';
                $this->saveHistory('Changed default currency to - ' . $_POST['newDefault'] . ' for firm id - ' . $_POST['forId']);
            } else {
                echo '0';
                log_message('error', 'Cant change default currency to - ' . $_POST['newDefault'] . ' for firm id - ' . $_POST['forId']);
            }
        } else {
            echo '0';
        }
    }

    public function deleteDefaultCurrency($num)
    {
        $result = $this->SettingsModel->deleteDefaultCurrency($num);
        if ($result == false) {
            log_message('error', 'Cant change default currency to null for id - ' . $num);
        }
        redirect(lang_url('user/settings/invoices'));
    }

    public function deleteCurrency($num)
    {
        $result = $this->SettingsModel->deleteMyCurrency($num);
        if ($result == false) {
            log_message('error', 'Cant delete my currency id - ' . $num);
        }
        redirect(lang_url('user/settings/invoices'));
    }

    public function deleteQuantityType($id)
    {
        $result = $this->SettingsModel->deleteCustomQuantityType($id);
        if ($result == false) {
            log_message('error', 'Cant delete my quantity type with id - ' . $id);
        }
        redirect(lang_url('user/settings/invoices'));
    }

}
