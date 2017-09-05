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
    private $warrantyNumber = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('WarrantyCardModel');
    }

    public function index($number)
    {
        $data = array();
        $head = array();
        $head['title'] =  lang('title_everytime') . lang('title_events');
        $warranty = $this->WarrantyCardModel->getWarrantyByNumber($number);
        if (empty($warranty)) {
            log_message('error', 'User with id - ' . USER_ID . ' gets 404 when try to open events for warranty with number - ' . $number);
            show_404();
        }
        $data['events'] = $this->WarrantyCardModel->getWarrantyEvents($warranty['id']);
        $data['eventId'] = $number;
        $this->render('warranty/events', $head, $data);
        $this->saveHistory('Go to events page');
    }

    public function addEvent($number)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_add_event');
        $warranty = $this->WarrantyCardModel->getWarrantyByNumber($number);
        if (empty($warranty)) {
            log_message('error', 'User with id - ' . USER_ID . ' gets 404 when try to add event for warranty with number - ' . $number);
            show_404();
        }
        $this->warrantyId = $warranty['id'];
        $this->warrantyNumber = $number;
        $data['warranty'] = $warranty;
        if (isset($_POST['item'])) {
            $this->setNewEvent();
        }
        $data['eventNumber'] = $number;
        $this->render('warranty/add_event', $head, $data);
        $this->saveHistory('Go to add events page');
    }

    private function setNewEvent()
    {
        $this->WarrantyCardModel->setWarrantyEvent($_POST, $this->warrantyId);
        $this->saveHistory('Add warranty event for warrantyId - ' . $this->warrantyNumber . ' and item - ' . $_POST['item']);
        redirect(lang_url('user/warranty/events/' . $this->warrantyNumber));
    }

}
