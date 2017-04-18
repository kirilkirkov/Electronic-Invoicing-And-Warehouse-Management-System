<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Addfeature extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('FeaturesModel', 'LanguagesModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Add Event';
        $data['languages'] = $this->LanguagesModel->getLanguages();
        if (isset($_POST['title'])) {
            $this->addFeature();
        }
        if (isset($_GET['edit'])) {
            $this->getFeature();
        }
        $this->render('features/addfeature', $head, $data);
        $this->saveHistory('Go to add feature');
    }

    private function addFeature()
    {
        $_POST['image'] = uploader('./attachments/featuresimages/');
        if ($_POST['image'] == false) {
            $_POST['image'] = $_POST['old_image'];
        }
        $this->FeaturesModel->addFeature($_POST);
        redirect('admin/features');
    }

    private function getFeature()
    {
        $_POST = $this->FeaturesModel->getFeature($_GET['edit']);
    }

}
