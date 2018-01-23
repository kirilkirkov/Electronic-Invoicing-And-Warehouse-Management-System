<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Employees extends USER_Controller
{

    private $num_rows = 20;
    private $editId;
    private $editEmployee;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('SettingsModel', 'HomeModel'));
        $paginationNumRows = $this->SettingsModel->getValueStores('opt_pagination');
        $this->num_rows = $paginationNumRows;
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_employees');
        $rowscount = $this->SettingsModel->countEmployees($_GET);
        $data['employees'] = $this->SettingsModel->getEmployees($this->num_rows, $page);
        $data['linksPagination'] = pagination('user/settings/employees', $rowscount, $this->num_rows, MY_DEFAULT_LANGUAGE_ABBR != MY_LANGUAGE_ABBR ? 5 : 4);
        $this->render('settings/employees', $head, $data);
        $this->saveHistory('Go to settings employees table page');
    }

    public function addNew($id = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_add_employee');
        $this->editId = $id;
        if (isset($_POST['name'])) {
            $_POST['editId'] = $id;
            $this->addEmployee();
        }
        if ($id > 0) {
            $result = $this->SettingsModel->getEmployeeInfo($id);
            if (empty($result)) {
                log_message('error', 'User with id - ' . USER_ID . ' gets 404 when try to edit employee with id - ' . $id);
                show_404();
            }
            unset($result['password']);
            $_POST = $result;
        }
        if ($this->session->flashdata('saveData') != null) {
            $_POST = $this->session->flashdata('saveData');
        }
        $data['myAccessFirms'] = $this->HomeModel->getEmployeeAvailableFirms($id);
        $data['editId'] = $this->editId;
        $this->render('settings/addEmployee', $head, $data);
        $this->saveHistory('Go to settings employees add page');
    }

    public function manageRights($id = 0)
    {
        $data = array();
        $head = array();
        $this->editEmployee = $id;
        $head['title'] = lang('title_everytime') . lang('title_empl_rights');
        if (isset($_POST['savePermissions'])) {
            $this->savePermissions();
        }
        $data['permissions'] = $this->config->item('permissions');
        $data['userPermissions'] = $this->SettingsModel->getEmployeePermissions($id);
        if (empty($data['userPermissions'])) {
            show_404();
        }
        $this->render('settings/employeeRights', $head, $data);
        $this->saveHistory('Go to rights employees page');
    }

    private function savePermissions()
    {
        $defaultPermissions = $this->config->item('permissions');
        $toDb = array();
        foreach ($defaultPermissions as $key => $val) {
            $toDb[$key] = isset($_POST[$key]) ? 1 : 0;
        }
        $this->SettingsModel->updateEmployeePermissions($toDb, $this->editEmployee);
        $this->session->set_flashdata('resultAction', lang('success_save_new_perms'));
        redirect(lang_url('user/settings/employees/rights/' . $this->editEmployee));
    }

    private function addEmployee()
    {
        $isValid = $this->validateEmployee();
        if ($isValid === true) {
            $insertId = $this->SettingsModel->setEmployee($_POST);
            if ($this->editId == 0) {
                $this->setNewEmployeePermissions($insertId);
            }
            $this->saveHistory('Add employee - ' . $_POST['email']);
            $this->session->set_flashdata('resultAction', lang('employee_add_success'));
            redirect(lang_url('user/settings/employees'));
        } else {
            $this->session->set_flashdata('resultAction', $isValid);
            $this->session->set_flashdata('saveData', $_POST);
            if ($this->editId > 0) {
                redirect(lang_url('user/settings/employees/add/' . $this->editId));
            } else {
                redirect(lang_url('user/settings/employees/add'));
            }
        }
    }

    private function setNewEmployeePermissions($employeeId)
    {
        $defaultPermissions = $this->config->item('permissions');
        $this->SettingsModel->setNewEmployeePermissions($employeeId, $defaultPermissions);
    }

    private function validateEmployee()
    {
        $errors = array();
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('invalid_email');
        } else {
            $isFree = $this->SettingsModel->checkEmployeeFreeEmail($_POST['email'], $this->editId);
            if ($isFree == false) {
                $errors[] = lang('employee_email_taken');
            }
        }
        if ($this->editId == 0) {
            if (mb_strlen(trim($_POST['password'])) == 0) {
                $errors[] = lang('empty_password');
            }
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

    public function deleteEmployee($id)
    {
        $this->SettingsModel->deleteEmployee($id);
        redirect(lang_url('user/settings/employees'));
    }

}
