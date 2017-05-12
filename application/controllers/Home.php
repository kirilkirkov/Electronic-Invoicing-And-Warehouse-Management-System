<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

    private $blogLimit = 5;

    public function index()
    {
        $data = array();
        $head = array();
        $data['last_articles'] = $this->PublicModel->lastInBlog($this->blogLimit);
        $this->render('home/index', $head, $data);
    }

    public function logout()
    {
        unset($_SESSION['user_login']);
        unset($_SESSION['selected_company']);
        redirect(base_url());
    }

}
