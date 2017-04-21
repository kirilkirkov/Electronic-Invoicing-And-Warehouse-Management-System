<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Managefirms extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ManagefirmsModel', 'HomeModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $data['firms'] = $this->HomeModel->getFirms(USER_ID);
        if (isset($_GET['delete'])) {
            $this->deleteCompany();
            redirect(lang_url('user/managefirms'));
        }
        $this->render('managefirms/index', $head, $data);
        $this->saveHistory('Go to home page');
    }

    private function deleteCompany()
    {
        $this->ManagefirmsModel->deleteCompany($_GET['delete'], USER_ID);
    }

}
