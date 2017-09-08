<?php

class PlansModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getMyPlanUnits()
    {
        $timeNow = time();
        $result = $this->db->query('SELECT SUM(num_invoices) as num_invoices, SUM(num_firms) as num_firms FROM firms_plans WHERE ' . $timeNow . ' >= from_date AND ' . $timeNow . ' <= to_date AND for_user = ' . USER_ID);
        return $result->row_array();
    }

    public function getMyPlanType()
    {
        $timeNow = time();
        $result = $this->db->query('SELECT plan_type FROM firms_plans WHERE ' . $timeNow . ' >= from_date AND ' . $timeNow . ' <= to_date AND for_user = ' . USER_ID . ' ORDER BY id DESC LIMIT 1');
        return $result->row_array();
    }

    public function setNewPaymentRequiest($req)
    {
        $this->db->select_max('req_num');
        $query = $this->db->get('firms_payment_requests');
        $row = $query->row_array();
        $newReqNum = (int) $row['req_num'] + 1;

        if (!$this->db->insert('firms_payment_requests', array(
                    'for_user' => USER_ID,
                    'req_num' => $newReqNum,
                    'payment_type' => $req['payment_type'],
                    'plan_type' => $req['type'],
                    'plan_period' => $req['period'],
                    'date_generated' => time(),
                    'status' => 0
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function getMyRequest()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('status', 0);
        $this->db->limit(1);
        $query = $this->db->get('firms_payment_requests');
        return $query->row_array();
    }

    public function cancelPaymentRequest($id)
    {
        $this->db->where('id', $id);
        if (!$this->db->update('firms_payment_requests', array(
                    'status' => 1
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function setPlanRequest($post)
    {
        $this->db->trans_begin();
        $this->db->where('for_user', USER_ID);
        $this->db->where('status', 0);
        $this->db->limit(1);
        if (!$this->db->update('cusom_plan_requests', array(
                    'status' => 1
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
        if (!$this->db->insert('cusom_plan_requests', array(
                    'for_user' => USER_ID,
                    'invoices' => $post['inv_per_month'],
                    'companies' => $post['want_companies'],
                    'time' => time()
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function getIndividualPlan()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->limit(1);
        $result = $this->db->get('individual_plans');
        return $result->row_array();
    }

    public function getRequestForIndividualPlan()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('status', 0);
        $this->db->limit(1);
        $result = $this->db->get('cusom_plan_requests');
        return $result->row_array();
    }

    public function getMyActivePlans()
    {
        $this->db->where('for_user', USER_ID);
        $this->db->where('from_date <=', time());
        $this->db->where('to_date >=', time());
        $result = $this->db->get('firms_plans');
        return $result->result_array();
    }

    /*
     * Num invoices issued when is not on payed plan
     * and not more before one month
     */

    public function getNumInvoicesIssuedForOneMonth()
    {
        $monthBefore = strtotime("-1 month", time());
        $result = $this->db->query("SELECT count(id) as num FROM invoices WHERE created > (SELECT to_date FROM firms_plans WHERE for_user = " . USER_ID . " ORDER BY to_date DESC LIMIT 1) AND created > " . $monthBefore . " AND for_user = " . USER_ID);
        return $result->row_array();
    }

}
