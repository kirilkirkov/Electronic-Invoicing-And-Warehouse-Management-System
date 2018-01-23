<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class GlobalSettings extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('SettingsModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_global_sett');
        $this->postChecker();
        $this->render('settings/global', $head, $data);
        $this->saveHistory('Go to settings employees table page');
    }

    private function postChecker()
    {
        if (isset($_POST['opt_pagination'])) {
            $this->setPaginationNum();
        }
    }

    private function setPaginationNum()
    {
        $this->SettingsModel->setValueStore('opt_pagination', (int) $_POST['opt_pagination']);
        redirect(lang_url('user/settings/global'));
    }

}
