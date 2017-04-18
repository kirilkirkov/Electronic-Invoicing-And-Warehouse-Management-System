<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ADMIN_Controller extends HEAD_Controller
{

    protected $history;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination', 'uploader', 'except_letters'));
        $this->load->model(array('GeneralAdminModel'));
        $this->login_check();
        $this->history = $this->config->item('admin_history');
    }

    protected function render($view, $head, $data = null)
    {
        $this->load->view('parts/general/header', $head);
        $this->load->view($view, $data);
        $this->load->view('parts/general/footer');
    }

    /*
     * If we dont have logged session and try to open 
     * different page from just /admin/ (login)..
     */

    private function login_check()
    {
        if (!$this->session->userdata('logged_in') && $this->uri->segment(2) != null) {
            redirect('admin');
        }
        $this->username = $this->session->userdata('logged_in');
        $this->user_id = @$_SESSION['logged_user_info']['id'];
    }

    protected function saveHistory($activity)
    {
        if ($this->history === true) {
            $this->GeneralAdminModel->setHistory($activity, $this->username, $this->user_id);
        }
    }

}
