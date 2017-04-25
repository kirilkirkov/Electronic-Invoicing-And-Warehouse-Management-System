<?php

class USER_Controller extends HEAD_Controller
{

    private $firms;

    public function __construct()
    {
        parent::__construct();
        $this->loginCheck();
        $this->hasFirmCkeck();
        $this->load->helper('uploader');
    }

    public function render($view, $head, $data = null)
    {
        $vars = array();
        $vars['myFirms'] = $this->firms;
        $this->load->vars($vars);

        $this->load->view('parts/header', $head);
        $this->load->view($view, $data);
        $this->load->view('parts/footer');
    }

    private function loginCheck()
    {
        if (!isset($_SESSION['user_login'])) {
            redirect(base_url());
        } else {
            $userInfo = $this->PublicModel->getUserInfoFromEmail($_SESSION['user_login']);
            if (!empty($userInfo)) {
                /*
                 *  DEFINE USER CONSTANTS
                 */
                define('USER_EMAIL', $userInfo['email']);
                define('USER_REGISTERED', $userInfo['time_registered']);
                define('USER_ID', $userInfo['id']);
            } else {
                log_message('error', ':Error: - User try to login, he have session but cant get user info from email: ' . $_SESSION['user_login']);
                redirect(base_url());
            }
        }
    }

    private function hasFirmCkeck()
    {
        $this->load->model('HomeModel');
        $firms = $this->HomeModel->getFirms(USER_ID);
        $this->firms = $firms;
        if (empty($firms) && uri_string() != 'user') {
            redirect(lang_url('user'));
        }
    }

    public function saveHistory()
    {
        
    }

    protected function validateCompanyDetails($checkBulstat = true)
    {
        $errors = array();
        if (mb_strlen(trim($_POST['firm_name'])) == 0) {
            $errors[] = lang('empty_firm_name');
        }
        if ($checkBulstat === true) {
            if (mb_strlen(trim($_POST['firm_bulstat'])) == 0) {
                $errors[] = lang('empty_firm_bulstat');
            } else {
                $result = $this->checkBulstatIsFree();
                if ($result == false) {
                    $errors[] = lang('bulstat_is_taken');
                }
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
        $this->session->set_flashdata('firm_bulstat', @$_POST['firm_bulstat']);
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

}
