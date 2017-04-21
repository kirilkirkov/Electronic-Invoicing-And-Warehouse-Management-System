<?php

class USER_Controller extends HEAD_Controller
{

    private $firms;

    public function __construct()
    {
        parent::__construct();
        $this->loginCheck();
        $this->hasFirmCkeck();
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

}
