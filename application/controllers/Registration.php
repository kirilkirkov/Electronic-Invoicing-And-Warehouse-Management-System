<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller
{

    public function index()
    {
        $data = array();
        $head = array();
        if (isset($_POST['email'])) {
            $result = $this->validateRegisterForm();
            if ($result === true) {
                $returned_email = $this->registerUser();
                $this->setUserLogin($returned_email, 1);
            } else {
                $this->session->set_flashdata('resultRegister', $result);
                redirect(lang_url('registration'));
            }
        }
        $head['title'] = lang('title_register');
        $head['description'] = lang('description_register');
        $this->render('registration/index', $head, $data);
    }

    private function validateRegisterForm()
    {
        $errors = array();
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('invalid_email');
        } else {
            $result_email_free = $this->PublicModel->checkUserFreeEmail($_POST['email']);
            if ($result_email_free !== true) {
                $errors[] = $result_email_free;
            }
        }
        if (mb_strlen(trim($_POST['password'])) == 0) {
            $errors[] = lang('empty_password');
        }
        if (empty($errors)) {
            return true;
        }
        $this->session->set_flashdata('email', $_POST['email']);
        $this->session->set_flashdata('password', $_POST['password']);
        $this->session->set_flashdata('password2', $_POST['password2']);
        return $errors;
    }

    private function registerUser()
    {
        @$_SESSION['reg_times'] += 1; //noob prevent of spam :)
        if ($_SESSION['reg_times'] < 20) {
            $this->load->helper('get_client_ip_address');
            $_POST['ip_address'] = get_client_ip_address();
            $this->PublicModel->registerUser($_POST);
            return $_POST['email'];
        }
    }

    public function login()
    {
        $data = array();
        $head = array();
        if (isset($_POST['email'])) {
            $this->loginCheck();
        }
        $head['title'] = lang('title_login');
        $head['description'] = lang('description_login');
        $this->render('registration/login', $head, $data);
    }

    private function loginCheck()
    {
        $result = $this->PublicModel->loginCheck($_POST);
        if ($result !== false) {
            if ($result == 3) {
                $_SESSION['savedPost'] = $_POST;
                redirect(lang_url('choose-type-of-login'));
            } else {
                $this->setUserLogin($_POST['email'], $result);
            }
        } else {
            $this->session->set_flashdata('email', $_POST['email']);
            $this->session->set_flashdata('loginErrors', lang('usr_or_pass_invalid'));
            redirect(lang_url('login'));
        }
    }

    public function forgotten()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_forgotten');
        $head['description'] = lang('description_forgotten');
        $this->render('registration/forgotten', $head, $data);
    }

    /*
     * Choose type of login if have user and employee
     * with this email and password
     */

    public function chooseType()
    {
        $data = array();
        $head = array();
        if (!$_SESSION['savedPost']) {
            redirect(lang_url());
        }
        if (isset($_GET['type'])) {
            if ($_GET['type'] != 1 && $_GET['type'] != 2) {
                show_404();
            }
            $validUser = $this->PublicModel->loginCheck($_SESSION['savedPost']);
            if ($validUser != false) {
                $this->setUserLogin($_SESSION['savedPost']['email'], $_GET['type']);
            } else {
                show_404();
            }
        }
        $this->render('registration/choosetype', $head, $data);
    }

}
