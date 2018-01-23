<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends MY_Controller
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
		$head['title'] = lang('title_help');
		$head['description'] = lang('description_help');
        $this->render('help/index', $head, $data);
    }

    public function rules()
    {
        $data = array();
        $head = array();
        $data['questions'] = $this->PublicModel->getQuestions();
		$head['title'] = lang('title_rules');
		$head['description'] = lang('description_rules');
        $this->render('help/rules', $head, $data);
    }

}
