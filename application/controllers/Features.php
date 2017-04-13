<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Features extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Articles_model');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Issue and project tracking system with many features';
        $head['description'] = 'pmTicket has many features like dashboard/agile, issue tracking, multilanguage, mobile friendly and etc.';
        $head['keywords'] = 'dashboard, aglile, issue tracking, multilanguage, mobilefriendly';
        $data['features'] = $this->Articles_model->getFeatures();
        $this->render('features', $head, $data);
    }

}
