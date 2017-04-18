<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Features extends ADMIN_Controller
{

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FeaturesModel');
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Features';
        if (isset($_GET['delete'])) {
            $this->FeaturesModel->deleteFeature($_GET['delete']);
        }
        $data['features'] = $this->FeaturesModel->getFeatures($this->num_rows, $page);
        $rowscount = $this->FeaturesModel->featuresCount();
        $data['links_pagination'] = pagination('admin/features', $rowscount, $this->num_rows, 3);
        $this->render('features/features', $head, $data);
        $this->saveHistory('Go to features');
    }

}
