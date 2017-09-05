<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('HomeModel', 'ReportsModel'));
    }

    public function index()
    {

        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime').lang('title_home_page');
        if (isset($_POST['firm_name'])) {
            $result = $this->validateCompanyDetails();
            if ($result === true) {
                $companyId = $this->setFirm();
                $this->addCompanyFolders($companyId);
                $this->saveHistory('Add company - ' . print_r($_POST, true));
                redirect(lang_url('user'));
            } else {
                $this->session->set_flashdata('resultAction', $result);
                redirect(lang_url('user'));
            }
        }
        $data['inv_readable_types'] = $this->config->item('inv_readable_types');
        if (SELECTED_COMPANY_ID != null) { // in first login we dont have companies and this is null
            $data['issuedInvoices'] = $this->ReportsModel->getIssuedInvoices();
        }
        $data['betweenDates'] = lang('all_the_time');
        $this->render('home/index', $head, $data);
        $this->saveHistory('Go to home page');
    }

    public function useCompany($companyId)
    {
        $canIUse = $this->HomeModel->checkCompanyIsValidForUser($companyId);
        if (!empty($canIUse)) {
            $_SESSION['selected_company'] = array(
                'id' => $canIUse['firm_id'],
                'name' => $canIUse['name']
            );
        }
        redirect(lang_url('user'));
    }

    private function setFirm()
    {
        $_POST['is_default'] = 1;
        $_POST['trans_name'] = 'default';
        $id = $this->HomeModel->setFirm($_POST);
        return $id;
    }

    public function findResults()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $result = $this->HomeModel->findResultsFromSearch($_POST['search']);
        if (!empty($result)) {
            $inv_readable_types = $this->config->item('inv_readable_types');
            include 'application/modules/users/views/home/searchResultsHtml.php';
        } else {
            include 'application/modules/users/views/home/noSearchResultsHtml.php';
        }
    }

}
