<?php

class USER_Controller extends HEAD_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->loginCheck();
    }

    public function render($view, $head, $data = null)
    {
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

    public function saveHistory()
    {
        
    }

}
