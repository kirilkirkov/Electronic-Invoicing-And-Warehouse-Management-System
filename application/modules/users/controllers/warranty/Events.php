<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Events extends USER_Controller
{

    private $warrantyId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('WarrantyCardModel');
    }

    public function index($number)
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $warranty = $this->WarrantyCardModel->getWarrantyByNumber($number);
        if (empty($warranty)) {
            show_404();
        }
        $data['events'] = $this->WarrantyCardModel->getWarrantyEvents($warranty['id']);
        $this->render('warranty/events', $head, $data);
        $this->saveHistory('Go to events page');
    }

    public function addEvent($number)
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $warranty = $this->WarrantyCardModel->getWarrantyByNumber($number);
        if (empty($warranty)) {
            show_404();
        }
        $this->warrantyId = $warranty['id'];
        $data['warranty'] = $warranty;
        if (isset($_POST['item'])) {
            $this->setNewEvent();
        }
        $this->render('warranty/add_event', $head, $data);
        $this->saveHistory('Go to add events page');
    }

    private function setNewEvent()
    {
        $this->WarrantyCardModel->setWarrantyEvent($_POST, $this->warrantyId);
        $this->saveHistory('Add warranty event for warrantyId - ' . $this->warrantyId . ' and item - ' . $_POST['item']);
        redirect(lang_url('user/warranty/events/' . $this->warrantyId));
    }

}
