<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Stores extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('SettingsModel', 'StoreModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_store_sett');
        $this->postChecker();
        $data['myStores'] = $this->StoreModel->getStores();
        $this->render('settings/stores', $head, $data);
        $this->saveHistory('Go to settings invoices page');
    }

    private function postChecker()
    {
        if (isset($_POST['newStore'])) {
            $this->addNewStore();
        }
        if (isset($_POST['deleteStore'])) {
            $this->deleteStore();
        }
        if (isset($_POST['stopMovementCalculator'])) {
            $this->updateMovementsCaluculatorUsage();
        }
        if (isset($_POST['opt_movementRoundTo'])) {
            $this->updateMovementsRoundTo();
        }
        if (isset($_POST['allowNegativeQuantities'])) {
            $this->updateNegativeQuantities();
        }
    }

    private function updateMovementsCaluculatorUsage()
    {
        $this->SettingsModel->setValueStore('opt_movementCalculator', isset($_POST['opt_movementCalculator']) ? 0 : 1);
        $this->saveHistory('Set calculator usage fo movements to - ' . $_POST['opt_movementCalculator'] == 0 ? 'off' : 'on');
        redirect(lang_url('user/settings/stores'));
    }

    private function updateMovementsRoundTo()
    {
        $this->SettingsModel->setValueStore('opt_movementRoundTo', $_POST['opt_movementRoundTo']);
        $this->saveHistory('Update round movements total to - ' . $_POST['opt_movementRoundTo']);
        redirect(lang_url('user/settings/stores'));
    }

    private function updateNegativeQuantities()
    {
        $this->SettingsModel->setValueStore('opt_negativeQuantities', isset($_POST['opt_negativeQuantities']) ? 0 : 1);
        $this->saveHistory('Update allow negative quantities - ' . $_POST['opt_negativeQuantities']);
        redirect(lang_url('user/settings/stores'));
    }

    private function addNewStore()
    {
        $errors = $this->validateStoreName();
        if (empty($errors)) {
            $this->SettingsModel->setNewStore($_POST['newStore']);
            $this->saveHistory('Add new store - ' . $_POST['newStore']);
            redirect(lang_url('user/settings/stores'));
        } else {
            $this->session->set_flashdata('resultAction', $errors);
            redirect(lang_url('user/settings/stores'));
        }
    }

    private function validateStoreName()
    {
        $errors = array();
        if (mb_strlen(trim($_POST['newStore'])) == 0) {
            $errors[] = lang('empty_store_name');
        } else {
            $isFree = $this->SettingsModel->checkStoreNameIsFree($_POST['newStore']);
            if ($isFree == false) {
                $errors[] = lang('store_name_taken');
            }
        }
        return $errors;
    }

    public function deleteStore($id)
    {
        $this->SettingsModel->deleteStore($id);
        $this->saveHistory('Add delete store - ' . $id);
        redirect(lang_url('user/settings/stores'));
    }

}
