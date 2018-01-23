<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Features extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $head = array();
		$head['title'] = lang('title_features');
		$head['description'] = lang('description_features');
        $data['features'] = $this->PublicModel->getFeatures();
        $this->render('features/index', $head, $data);
    }

    public function importers()
    {
        $data = array();
        $head = array();
		$head['title'] = lang('title_importers');
		$head['description'] = lang('description_importers');
        $this->render('features/importers', $head, $data);
    }

    public function exporters()
    {
        $data = array();
        $head = array();
		$head['title'] = lang('title_exporters');
		$head['description'] = lang('description_exporters');
        $this->render('features/exporters', $head, $data);
    }

}
