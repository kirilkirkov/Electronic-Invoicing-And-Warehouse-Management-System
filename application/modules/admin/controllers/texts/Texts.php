<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Texts extends ADMIN_Controller
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
        if (isset($_POST['admin_info'])) {
            $this->addText();
        }
        if (isset($_POST['text_e'])) {
            $this->editText();
        }
        $head['title'] = 'Administration - Pages Texts';
        $data['texts'] = $this->TextsModel->getTexts();
        $data['languages'] = $this->LanguagesModel->getLanguages();
        $this->render('texts/index', $head, $data);
        $this->saveHistory('Go to texts page');
    }

    private function addText()
    {
        $this->TextsModel->addText($_POST);
        $this->saveHistory('Add new text');
        redirect('admin/texts');
    }

    private function editText()
    {
        $this->TextsModel->editText($_POST);
        $this->saveHistory('Edit text page - ' . $_POST['info']);
        redirect('admin/texts');
    }

}
