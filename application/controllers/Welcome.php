<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    private $blogLimit = 5;

    public function index()
    {
        $this->load->view('parts/header');
        $data['last_articles'] = $this->PublicModel->lastInBlog($this->blogLimit);
        $this->load->view('home', $data);
        $this->load->view('parts/footer');
    }

}
