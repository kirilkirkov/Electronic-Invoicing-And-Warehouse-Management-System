<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * This class loads users plans
 */

class Plans
{

    private $CI;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model('PlansModel');
    }

    public function getMyCurrentPlanUnits()
    {
        $myPlanUnits = $this->CI->PlansModel->getMyPlanUnits();
        if ($myPlanUnits['num_invoices'] == null) {
            $myPlanUnits['num_invoices'] = 0;
        }
        if ($myPlanUnits['num_firms'] == null) {
            $myPlanUnits['num_firms'] = 0;
        }
        return $myPlanUnits;
    }

    public function myCurrentPlanType()
    {
        $myPlanType = $this->CI->PlansModel->getMyPlanType();
        return $myPlanType['plan_type'];
    }

    public function checkHaveIRequest()
    {
        $myRequest = $this->CI->PlansModel->getMyRequest();
        if ($myRequest == null) {
            return false;
        }
        return true;
    }

}
