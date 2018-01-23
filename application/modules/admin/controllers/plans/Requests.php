<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Requests extends ADMIN_Controller
{

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RequestsModel');
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        if (isset($_GET['activate'])) {
            $this->activatePaymentRequest($_GET['activate']);
        }
        $head['title'] = 'Administration - Requests';
        $data['requests'] = $this->RequestsModel->getRequests($this->num_rows, $page);
        $rowscount = $this->RequestsModel->requestsCount();
        $data['links_pagination'] = pagination('admin/plans/requests', $rowscount, $this->num_rows, 4);
        $data['defaultPlans'] = $this->config->item('plans');
        $this->render('plans/requests', $head, $data);
        $this->saveHistory('Go to plans->requests');
    }

    private function activatePaymentRequest($id)
    {
        $this->RequestsModel->activateRequestId($id);
        $this->saveHistory('Activate payment request id - ' . $id);
        redirect(base_url('admin/plans/requests'));
    }

    public function custom()
    {
        $data = array();
        $head = array();
        if (isset($_GET['activate'])) {
            $this->RequestsModel->setIndividualPlan($_GET['activate'], $_GET['price'], $_GET['for_user']);
        }
        if (isset($_GET['reject'])) {
            $this->RequestsModel->rejectIndividualPlanRequest($_GET['reject']);
        }
        $head['title'] = 'Administration - Custom Plan Requests';
        $data['requests'] = $this->RequestsModel->getCustomPlanRequests($this->num_rows, $page);
        $rowscount = $this->RequestsModel->customPlanRequestsCount();
        $data['links_pagination'] = pagination('admin/plans/individual/request', $rowscount, $this->num_rows, 5);
        $this->render('plans/individual_plan_requests', $head, $data);
        $this->saveHistory('Go to plans->requests->custom plan');
    }

}
