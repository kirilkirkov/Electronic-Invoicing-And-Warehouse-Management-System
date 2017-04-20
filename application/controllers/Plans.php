<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $head = array();
        $data['questions'] = $this->PublicModel->getQuestions();
        $head['title'] = 'Collaboration Software Support - 24/7';
        $head['description'] = 'Use pmTicket.com online for minimal price on the internet and get 24/7 support';
        $head['keywords'] = '24/7 support, pmTicket support, pmTicket online support';
        $this->render('plans/index', $head, $data);
    }

}
