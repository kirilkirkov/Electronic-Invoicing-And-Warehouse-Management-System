<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Questions extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('TextsModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        if (isset($_GET['delete'])) {
            $this->TextsModel->deleteQuestion($_GET['delete']);
        }
        $head['title'] = 'Administration - Frequently Asked Questions';
        $data['questions'] = $this->TextsModel->getQuestions();
        $this->render('texts/questions', $head, $data);
        $this->saveHistory('Go to Frequently Asked Questions');
    }

}
