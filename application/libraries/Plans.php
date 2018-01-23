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

    /*
     * The system wait for constant number firms
     * number of invoces are decrease when create
     */

    public function getMyCurrentPlanUnits()
    {
        $myPlanUnits = $this->CI->PlansModel->getMyPlanUnits();

        /*
         * If both are null, there is not plan to this account
         * Lets calculate free plan units
         */
        if ($myPlanUnits['num_invoices'] == null && $myPlanUnits['num_firms'] == null) {
            $myPlanUnits['num_invoices'] = $this->calculateFreePlanLeftNumInvoices();
            $myPlanUnits['num_firms'] = 1;
        }
        return $myPlanUnits;
    }

    /*
     * Caluculate left invoices for free plan work when from 5 we remove
     * number of all issued invoices for one month back
     * when we are not in payed plan
     */

    private function calculateFreePlanLeftNumInvoices()
    {
        $numArr = $this->CI->PlansModel->getNumInvoicesIssuedForOneMonth();
        $num = $numArr['num'];
        return 5 - $num;
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
