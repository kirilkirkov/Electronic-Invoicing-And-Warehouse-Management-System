<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller
{

    public function index()
    {
        $data = array();
        $head = array();
        if (isset($_POST['email'])) {

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->session->set_flashdata('resultRegister', 'Invalid email');
                redirect(lang_url('registration'));
            }

            $takenEmail = $this->PublicModel->checkUserFreeEmail($_POST['email']);
            if($takenEmail !== true) {
                $this->session->set_flashdata('resultRegister', $takenEmail);
                redirect(lang_url('registration'));
            }

            $result = $this->PublicModel->registerUser($_POST);
            if ($result === true) {
                // $returned_email = $this->registerUser();
                // $this->setUserLogin($returned_email, 1);
                redirect(lang_url('login'));
            } else {
                $this->session->set_flashdata('resultRegister', $result);
                redirect(lang_url('registration'));
            }
        }
        $head['title'] = lang('title_register');
        $head['description'] = lang('description_register');
        $this->render('registration/index', $head, $data);
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
}
