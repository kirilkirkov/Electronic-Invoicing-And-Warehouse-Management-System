<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Addquestion extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('TextsModel', 'LanguagesModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        if (isset($_POST['question'])) {
            $this->addQuestion();
        }
        if (isset($_GET['edit'])) {
            $this->getQuestion();
        }
        $head['title'] = 'Administration - Add Question';
        $data['languages'] = $this->LanguagesModel->getLanguages();
        $data['questions'] = $this->TextsModel->getQuestions();
        $this->render('texts/addquestion', $head, $data);
        $this->saveHistory('Go to add question page');
    }

    private function addQuestion()
    {
        $this->TextsModel->addQuestion($_POST);
        redirect('admin/questions');
    }

    private function getQuestion()
    {
        $_POST = $this->TextsModel->getQuestion($_GET['edit']);
    }

}
