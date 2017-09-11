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
        $this->postChecker();
        $head['title'] = lang('title_everytime') . lang('title_inv_sett');
        $data['myFirms'] = $this->SettingsModel->getMyFirmsDefaultCurrency();
        $data['currencies'] = $this->NewInvoiceModel->getCurrencies();
        $data['myCurrencies'] = $this->SettingsModel->getMyCurrencies();
        $data['myQuantityTypes'] = $this->SettingsModel->getMyQuantityTypes();
        $data['myPaymentMethods'] = $this->SettingsModel->getMyPaymentMethods();
        $data['myNoVatReasons'] = $this->SettingsModel->getMyNoVatReasons();
        $data['opt_invTemplate'] = $this->SettingsModel->getValueStores('opt_invTemplate');
        $this->render('settings/invoices', $head, $data);
        $this->saveHistory('Go to settings invoices page');
    }

    private function postChecker()
    {
        if (isset($_POST['currencyName'])) {
            $this->addCurrency();
        }
        if (isset($_POST['quantityTypeName'])) {
            $this->addQuantityType();
        }
        if (isset($_POST['paymentMethodName'])) {
            $this->addPaymentMethod();
        }
        if (isset($_POST['noVatReason'])) {
            $this->addNewNoVatReason();
        }
        if (isset($_POST['noVatReason'])) {
            $this->addNewNoVatReason();
        }
        if (isset($_POST['opt_invRoundTo'])) {
            $this->updateInvoicesRoundTo();
        }
        if (isset($_POST['updateInvCalculator'])) {
            $this->updateInvCaluculatorUsage();
        }
        if (isset($_POST['updateInvTemplate'])) {
            $this->updateInvTemplate();
        }
    }

    private function updateInvCaluculatorUsage()
    {
        $this->SettingsModel->setValueStore('opt_invCalculator', isset($_POST['opt_invCalculator']) ? 0 : 1);
        $this->saveHistory('Set calculator usage to - ' . $_POST['opt_invCalculator'] == 0 ? 'off' : 'on');
        redirect(lang_url('user/settings/invoices'));
    }

    private function updateInvoicesRoundTo()
    {
        $this->SettingsModel->setValueStore('opt_invRoundTo', $_POST['opt_invRoundTo']);
        $this->saveHistory('Update round invoices total to - ' . $_POST['opt_invRoundTo']);
        redirect(lang_url('user/settings/invoices'));
    }

    private function addNewNoVatReason()
    {
        $this->NewInvoiceModel->setNewVatReason($_POST['noVatReason']);
        $this->saveHistory('Add new vat reason - ' . $_POST['noVatReason']);
        redirect(lang_url('user/settings/invoices'));
    }

    private function addPaymentMethod()
    {
        $this->NewInvoiceModel->setNewCustomPaymentMethod($_POST['paymentMethodName']);
        $this->saveHistory('Add new payment method - ' . $_POST['paymentMethodName']);
        redirect(lang_url('user/settings/invoices'));
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

    private function updateInvTemplate()
    {
        $this->SettingsModel->setValueStore('opt_invTemplate', $_POST['invTempl']);
        $this->saveHistory('Update invoices template to - ' . $_POST['invTempl']);
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
            $this->SettingsModel->setNewDefaultCurrency($_POST);
            echo '1';
            $this->saveHistory('Changed default currency to - ' . $_POST['newDefault'] . ' for firm id - ' . $_POST['forId']);
        } else {
            echo '0';
        }
    }

    public function deleteDefaultCurrency($num)
    {
        $this->SettingsModel->deleteDefaultCurrency($num);
        redirect(lang_url('user/settings/invoices'));
    }

    public function deleteCurrency($num)
    {
        $this->SettingsModel->deleteMyCurrency($num);
        redirect(lang_url('user/settings/invoices'));
    }

    public function deleteQuantityType($id)
    {
        $this->SettingsModel->deleteCustomQuantityType($id);
        redirect(lang_url('user/settings/invoices'));
    }

    public function deletePaymentMethod($id)
    {
        $this->SettingsModel->deleteCustomPaymentMethod($id);
        redirect(lang_url('user/settings/invoices'));
    }

    public function deleteNoVatReason($id)
    {
        $this->SettingsModel->deleteMyNoVatReason($id);
        redirect(lang_url('user/settings/invoices'));
    }

}
