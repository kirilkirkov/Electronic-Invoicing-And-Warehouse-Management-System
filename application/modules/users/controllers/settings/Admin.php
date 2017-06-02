<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingsModel');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Settings';
        if (isset($_POST['name'])) {
            $this->updateUser();
        }
        $_POST = $this->SettingsModel->getAdminInfo();
        $this->render('settings/admin', $head, $data);
        $this->saveHistory('Go to settings employees table page');
    }

    private function updateUser()
    {
        $isValid = $this->validateUserData();
        if ($isValid === true) {
            $this->SettingsModel->updateUserAdminInfo($_POST);
            $this->session->set_flashdata('resultAction', lang('success_update_user_adm'));
        } else {
            $this->session->set_flashdata('resultAction', $isValid);
        }
        redirect(lang_url('user/admin'));
    }

    private function validateUserData()
    {
        $errors = array();
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('invalid_email');
        } else {
            $result_email_free = $this->SettingsModel->checkRegisteredUserFreeEmail($_POST['email']);
            if ($result_email_free !== true) {
                $errors[] = lang('problem_update_user_adm_em');
            }
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

}
