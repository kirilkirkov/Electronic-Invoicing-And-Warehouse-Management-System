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
                $this->setUserLogin($returned_email);
            } else {
                $this->session->set_flashdata('resultRegister', $result);
                redirect(lang_url('registration'));
            }
        }
        $this->render('registration/index', $head, $data);
    }

    private function validateRegisterForm()
    {
        $errors = array();
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('invalid_email');
        } else {
            $result_email_free = $this->PublicModel->checkFreeEmail($_POST['email']);
            if ($result_email_free !== true) {
                $errors[] = $result_email_free;
            }
        }
        if (mb_strlen(trim($_POST['password'])) == 0) {
            $errors[] = lang('empty_password');
        } else {
            if (mb_strlen(trim($_POST['repeat_password'])) == 0) {
                $errors[] = lang('empty_password_repeat');
            } else {
                if ($_POST['password'] != $_POST['repeat_password']) {
                    $errors[] = lang('passwords_dont_mutch');
                }
            }
        }
        if (!isset($_POST['rules'])) {
            $errors[] = lang('rules_not_checked');
        }
        if (empty($errors)) {
            return true;
        }
        $this->session->set_flashdata('email', $_POST['email']);
        $this->session->set_flashdata('password', $_POST['password']);
        $this->session->set_flashdata('repeat_password', $_POST['repeat_password']);
        if (isset($_POST['rules'])) {
            $this->session->set_flashdata('rules', $_POST['rules']);
        }
        return $errors;
    }

    private function registerUser()
    {
        @$_SESSION['reg_times'] += 1; //noob prevent of spam :)
        if ($_SESSION['reg_times'] < 20) {
            $registered = $this->PublicModel->registerUser($_POST);
            if ($registered == false) {
                log_message('error', 'Cant save user: ' . print_r($_POST, true));
                show_error(lang('registration_error'));
            } else {
                return $_POST['email'];
            }
        }
    }

}
