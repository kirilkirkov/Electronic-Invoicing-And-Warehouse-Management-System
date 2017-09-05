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

    public function __construct()
    {
        parent::__construct();
        $this->load->model('WarrantyCardModel');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_warr_sett');
        if (isset($_POST['condition'])) {
            $this->setNewCondition();
        }
        $data['myConditions'] = $this->WarrantyCardModel->getWarrantyConditions();
        $this->render('settings/warranty', $head, $data);
        $this->saveHistory('Go to settings invoices page');
    }

    private function setNewCondition()
    {
        $this->WarrantyCardModel->setNewCondition($_POST);
        $this->saveHistory('Add new warranty condition - ' . $_POST['conditionTitle']);
        redirect(lang_url('user/settings/warranty'));
    }

    public function deleteCondition($id)
    {
        $this->WarrantyCardModel->deleteWarrantyCondition($id);
        $this->saveHistory('Delete warranty condition - ' . $id);
        redirect(lang_url('user/settings/warranty'));
    }

}
