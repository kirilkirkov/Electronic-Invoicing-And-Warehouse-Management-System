<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $this->render('home/index', $head, $data);
        $this->saveHistory('Go to home page');
    }

    public function logout()
    {
        unset($_SESSION['user_login']);
        redirect(base_url());
    }

}
