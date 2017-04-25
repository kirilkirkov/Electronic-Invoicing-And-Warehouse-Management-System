<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        if (isset($_POST['firm_name'])) {
            $errors = $this->validateCompanyDetails();
            if (empty($errors)) {
                $this->setFirm();
                $this->saveHistory('Add company - ' . print_r($_POST, true));
                redirect(lang_url('user'));
            } else {
                $this->session->set_flashdata('resultAction', $result);
                redirect(lang_url('user'));
            }
        }
        $this->render('home/index', $head, $data);
        $this->saveHistory('Go to home page');
    }

    private function setFirm()
    {
        $_POST['is_default'] = 1;
        $this->HomeModel->setFirm($_POST);
    }

    public function logout()
    {
        unset($_SESSION['user_login']);
        redirect(base_url());
    }

}
