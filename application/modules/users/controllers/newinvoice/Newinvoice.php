<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Newinvoice extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('NewInvoiceModel');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $this->render('newinvoice/index', $head, $data);
        $this->saveHistory('Go to new invoice page');
    }

}
