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
            $result = $this->validateCompanyDetails();
            if ($result === true) {
                $this->setFirm();
                redirect(lang_url('user'));
            } else {
                $this->session->set_flashdata('problemAddFirm', $result);
                redirect(lang_url('user'));
            }
        }
        $this->render('home/index', $head, $data);
        $this->saveHistory('Go to home page');
    }

    private function setFirm()
    {
        $_POST['for_user'] = USER_ID;
        $_POST['is_default'] = 1;
        $this->HomeModel->setFirm($_POST);
    }

    private function validateCompanyDetails()
    {
        $errors = array();
        if (mb_strlen(trim($_POST['firm_name'])) == 0) {
            $errors[] = lang('empty_firm_name');
        }
        if (mb_strlen(trim($_POST['firm_bulstat'])) == 0) {
            $errors[] = lang('empty_firm_bulstat');
        } else {
            $result = $this->checkBulstatIsFree();
            if ($result == false) {
                $errors[] = lang('bulstat_is_taken');
            }
        }
        if (mb_strlen(trim($_POST['firm_reg_address'])) == 0) {
            $errors[] = lang('empty_firm_reg_address');
        }
        if (mb_strlen(trim($_POST['firm_city'])) == 0) {
            $errors[] = lang('empty_firm_city');
        }
        if (mb_strlen(trim($_POST['firm_mol'])) == 0) {
            $errors[] = lang('empty_firm_mol');
        }
        if (empty($errors)) {
            return true;
        }
        $this->session->set_flashdata('firm_name', $_POST['firm_name']);
        $this->session->set_flashdata('firm_bulstat', $_POST['firm_bulstat']);
        $this->session->set_flashdata('firm_reg_address', $_POST['firm_reg_address']);
        $this->session->set_flashdata('firm_city', $_POST['firm_city']);
        $this->session->set_flashdata('firm_mol', $_POST['firm_mol']);
        return $errors;
    }

    private function checkBulstatIsFree()
    {
        $result = $this->HomeModel->checkBulstatIsFree($_POST['firm_bulstat']);
        return $result;
    }

    public function logout()
    {
        unset($_SESSION['user_login']);
        redirect(base_url());
    }

}
