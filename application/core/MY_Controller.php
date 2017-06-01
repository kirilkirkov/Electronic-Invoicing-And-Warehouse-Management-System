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

    public function setUserLogin($email, $type)
    {
        $userInfo = $this->PublicModel->getUserInfoFromEmail($email, $type);
        if (!empty($userInfo)) {
            if ($type == 2) {
                $email = $userInfo['employee']['email'];
            } else {
                $email = $userInfo['user']['email'];
            }
            $_SESSION['user_login'] = array(
                'email' => $email,
                'type' => $type
            );
            redirect(lang_url('user'));
        } else {
            log_message('error', ':Error: - Cant set user login for email: ' . $email);
            redirect(base_url());
        }
    }

}
