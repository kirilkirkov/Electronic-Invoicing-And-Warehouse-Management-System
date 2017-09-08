<?php

class USER_Controller extends HEAD_Controller
{

    private $firms;
    protected $firmInfo;
    public $userInfo;
    public $planUnits;

    public function __construct()
    {
        parent::__construct();
        $this->loginCheck();
        $this->load->helper(array(
            'uploader',
            'pagination'
        ));
        $this->load->library(array(
            'MailSend',
            'Plans'
        ));
        $this->planUnits = $this->plans->getMyCurrentPlanUnits();
        $this->firmCkecker();
    }

    public function render($view, $head, $data = null)
    {
        $vars = array();
        $vars = $this->loadValueStores();
        $vars['myFirms'] = $this->firms;
        $vars['canUseFirms'] = $this->canUseFirms;
        $vars['firmInfo'] = $this->firmInfo;
        $this->load->vars($vars);
        $head['planUnits'] = $this->planUnits;
        $this->load->view('parts/header', $head);
        $this->load->view($view, $data);
        $this->load->view('parts/footer');
    }

    /*
     * If session type == 2 is employee
     * and return info for him
     */

    private function loginCheck()
    {
        if (!isset($_SESSION['user_login'])) {
            redirect(lang_url('login'));
        } else {
            $userInfo = $this->PublicModel->getUserInfoFromEmail($_SESSION['user_login']['email'], $_SESSION['user_login']['type']);
            if (!empty($userInfo) && $userInfo['user'] != null) {
                $this->userInfo = $userInfo;
                /*
                 *  DEFINE USER AND EMPLOYEE CONSTANTS
                 */
                define('USER_ID', $userInfo['user']['id']);
                if (isset($userInfo['employee'])) {
                    define('EMPLOYEE_ID', $userInfo['employee']['id']);
                }
                $this->loadPermissions();
            } else {
                log_message('error', ':Error: - User try to login, he have session but cant get user info from email: ' . $_SESSION['user_login']);
                redirect(base_url());
            }
        }
    }

    private function loadPermissions()
    {
        $permissions = null;
        if (defined('EMPLOYEE_ID')) {
            $this->load->model('SettingsModel');
            $permissions = $this->SettingsModel->getPermissions();
        }
        $this->load->library('permissions', $permissions);
    }

    /*
     * Check user or employee selected firm
     * Check rights to access selected firm
     */

    private function firmCkecker()
    {
        $this->load->model('HomeModel');
        $defaultFirmForUser = $this->HomeModel->getDefaultCompany();
        $firmsForUser = $this->HomeModel->getFirms();
        if (isset($_SESSION['selected_company'])) {
            $isValidFirmForUser = $this->HomeModel->checkCompanyIsValidForUser($_SESSION['selected_company']['id']);
            if (!empty($isValidFirmForUser)) {
                $selectedFirmId = $_SESSION['selected_company']['id'];
                $this->firmInfo = $isValidFirmForUser;
            } else {
                $selectedFirmId = $defaultFirmForUser['id'];
                $this->firmInfo = $defaultFirmForUser;
                unset($_SESSION['selected_company']);
            }
        } else {
            $selectedFirmId = $defaultFirmForUser['id'];
            $this->firmInfo = $defaultFirmForUser;
        }
        if (!defined('EMPLOYEE_ID')) {
            $firmId = $selectedFirmId;
            $canUseFirms = array();
            foreach ($firmsForUser as $frm) {
                array_push($canUseFirms, $frm['id']);
            }
        } else {
            $employeeFirms = $canUseFirms = $this->HomeModel->getEmployeeAvailableFirms();
            if (!empty($employeeFirms)) {
                if (in_array($selectedFirmId, $employeeFirms)) {
                    $firmId = $selectedFirmId;
                } else {
                    $firmId = $employeeFirms[0];
                }
            } else {
                show_error(lang('you_cant_view_any_firms'));
            }
        }
        define('SELECTED_COMPANY_ID', $firmId);
        $this->firms = $firmsForUser;
        $this->canUseFirms = $canUseFirms;
        if (empty($firmsForUser) && (uri_string() != 'user' && uri_string() != $this->language->getUrlAbbrevation() . '/user')) {
            redirect(lang_url('user'));
        }
        $this->checkExceededLimitOfCompanies();
    }

    /*
     * if we have added companies
     * check how many companies we can use
     * for selected plan
     */

    private function checkExceededLimitOfCompanies()
    {
        if (!empty($this->firms)) {
            $planUnits = $this->planUnits;
            if (count($this->firms) > $planUnits['num_firms']) {
                // pages that are allowed to view
                if (uri_string() != 'user/managefirms' &&
                        uri_string() != $this->language->getUrlAbbrevation() . '/user/managefirms' &&
                        $this->uri->segment(2) != 'plans' &&
                        $this->uri->segment(2) != 'plan' &&
                        $this->uri->segment(2) != 'myplan') {
                    redirect(lang_url('user/managefirms'));
                }
            }
        }
    }

    public function saveHistory()
    {
        //INSERT DELAYED
    }

    protected function validateCompanyDetails($checkBulstat = true)
    {
        $errors = array();
        if (mb_strlen(trim($_POST['firm_name'])) == 0) {
            $errors[] = lang('empty_firm_name');
        }
        if ($checkBulstat === true) {
            if (mb_strlen(trim($_POST['firm_bulstat'])) == 0) {
                $errors[] = lang('empty_firm_bulstat');
            } else {
                $result = $this->checkBulstatIsFree();
                if ($result == false) {
                    $errors[] = lang('bulstat_is_taken');
                }
            }
        }
        if (mb_strlen(trim($_POST['firm_reg_address'])) == 0) {
            $errors[] = lang('empty_firm_reg_address');
        }
        if (mb_strlen(trim($_POST['firm_city'])) == 0) {
            $errors[] = lang('empty_firm_city');
        }
        if (mb_strlen(trim($_POST['firm_mol'])) == 0) {
            $errors[] = lang('empty_firm_mol');
        }
        if (empty($errors)) {
            return true;
        }
        $this->session->set_flashdata('firm_name', $_POST['firm_name']);
        $this->session->set_flashdata('firm_bulstat', @$_POST['firm_bulstat']);
        $this->session->set_flashdata('firm_reg_address', $_POST['firm_reg_address']);
        $this->session->set_flashdata('firm_city', $_POST['firm_city']);
        $this->session->set_flashdata('firm_mol', $_POST['firm_mol']);
        return $errors;
    }

    protected function addCompanyFolders($companyId)
    {
        if (!mkdir('./attachments/' . COMPANIES_IMAGES_DIR . '/' . $companyId, 0777)) {
            log_message('error', 'Error create company folder: ./attachments/' . COMPANIES_IMAGES_DIR . '/' . $companyId);
        }
    }

    private function checkBulstatIsFree()
    {
        $result = $this->HomeModel->checkBulstatIsFree($_POST['firm_bulstat']);
        return $result;
    }

    private function loadValueStores()
    {
        $result = $this->PublicModel->getValueStores();
        if (empty($result)) {
            show_error(lang('error_load_options'));
        }
        return $result;
    }

}
