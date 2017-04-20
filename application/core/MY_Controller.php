<?php

class MY_Controller extends HEAD_Controller
{

    public function __construct()
    {
        parent::__construct(); 
    }

    public function render($view, $head, $data = null)
    {
        $this->load->view('parts/header', $head);
        $this->load->view($view, $data);
        $this->load->view('parts/footer');
    }

    public function setUserLogin($email)
    {
        $userInfo = $this->PublicModel->getUserInfoFromEmail($email);
        if (!empty($userInfo)) {
            $_SESSION['user_login'] = $userInfo;
            redirect(lang_url('user'));
        } else {
            log_message('error', 'Cant set user login for email: ' . $email);
            redirect(base_url());
        }
    }

}
