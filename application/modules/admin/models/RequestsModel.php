<?php

class RequestsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getRequests($limit, $page)
    {
        $this->db->select('firms_payment_requests.*, individual_plans.price');
        $this->db->where('status', 0);
        $this->db->join('individual_plans', 'individual_plans.for_user = firms_payment_requests.for_user', 'left');
        $query = $this->db->get('firms_payment_requests', $limit, $page);
        return $query->result_array();
    }

    public function requestsCount()
    {
        $this->db->where('status', 0);
        return $this->db->count_all_results('firms_payment_requests');
    }

    public function activateRequestId($id)
    {
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->update('firms_payment_requests', array(
            'status' => 2,
            'date_activated' => time()
        ));

        $this->db->where('id', $id);
        $result = $this->db->get('firms_payment_requests');
        $row = $result->row_array();

        if ($row['plan_type'] == 'CUSTOM') {
            $this->db->where('for_user', $row['for_user']);
            $result = $this->db->get('individual_plans');
            $rowPlan = $result->row_array();
        } else {
            $plansArray = $this->config->item('plans');
            $rowPlan = $plansArray[$row['plan_type']];
        }

        $toDate = strtotime("+" . $row['plan_period'] . " month", time());
        if ($row['plan_type'] == 'PRO') {
            $toDate = strtotime("+1 month", $toDate);
        }
        $this->db->insert('firms_plans', array(
            'for_user' => $row['for_user'],
            'from_date' => time(),
            'to_date' => $toDate,
            'plan_type' => $row['plan_type'],
            'num_invoices' => $row['plan_type'] == 'CUSTOM' ? $rowPlan['num_invoices'] : $rowPlan['NUM_INVOICES'],
            'num_firms' => $row['plan_type'] == 'CUSTOM' ? $rowPlan['num_firms'] : $rowPlan['NUM_FIRMS'],
            'time' => time()
        ));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function customPlanRequestsCount()
    {
        $this->db->where('status', 0);
        return $this->db->count_all_results('cusom_plan_requests');
    }

    public function getCustomPlanRequests($limit, $page)
    {
        $this->db->where('status', 0);
        $query = $this->db->get('cusom_plan_requests', $limit, $page);
        return $query->result_array();
    }

    public function setIndividualPlan($id, $price, $for_user)
    {
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->where('status', 0);
        $this->db->update('cusom_plan_requests', array(
            'status' => 2
        ));

        $this->db->where('id', $id);
        $query = $this->db->get('cusom_plan_requests');
        $customReq = $query->row_array();

        $this->db->where('for_user', $for_user);
        $numIndividual = $this->db->count_all_results('individual_plans');
        if ($numIndividual > 0) {
            $this->db->where('for_user', $for_user);
            $this->db->update('individual_plans', array(
                'num_invoices' => $customReq['invoices'],
                'num_firms' => $customReq['companies'],
                'price' => $price
            ));
        } else {
            $this->db->insert('individual_plans', array(
                'for_user' => $for_user,
                'num_invoices' => $customReq['invoices'],
                'num_firms' => $customReq['companies'],
                'price' => $price
            ));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function rejectIndividualPlanRequest($id)
    {
        $this->db->where('id', $id);
        if (!$this->db->update('cusom_plan_requests', array(
                    'status' => 2
                ))) {
            show_error(lang('database_error'));
        }
    }

}
