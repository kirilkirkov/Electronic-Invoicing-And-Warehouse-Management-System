<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Clients extends USER_Controller
{

    private $num_rows = 20;
    private $editId;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ClientsModel', 'NewInvoiceModel', 'SettingsModel'));
        $paginationNumRows = $this->SettingsModel->getValueStores('opt_pagination');
        $this->num_rows = $paginationNumRows;
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime').lang('title_clients');
        $this->postChecker();
        $rowscount = $this->ClientsModel->countClients($_GET);
        $data['clients'] = $this->ClientsModel->getClients($this->num_rows, $page, $_GET);
        $data['linksPagination'] = pagination('user/clients', $rowscount, $this->num_rows, MY_DEFAULT_LANGUAGE_ABBR != MY_LANGUAGE_ABBR ? 4 : 3);
        $this->render('clients/index', $head, $data);
        $this->saveHistory('Go to clients page');
    }

    public function addClient($id = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime').lang('title_add_client');
        $this->editId = $id;
        $this->postChecker();
        if ($id > 0) {
            $result = $this->ClientsModel->getClientInfo($id);
            if (empty($result)) {
                log_message('error', 'User with id - ' . USER_ID . ' get 404 when try to edit client with id -' . $id);
                show_404();
            }
            $_POST = $result;
        }
        $data['editId'] = $id;
        $this->render('clients/addclient', $head, $data);
        $this->saveHistory('Go to add client page');
    }

    private function postChecker()
    {
        if (isset($_POST['client_name'])) {
            $this->setClient();
        }
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                $this->deleteSelectedClients($_POST['ids']);
            }
        }
    }

    private function deleteSelectedClients($ids)
    {
        $this->ClientsModel->multipleDeleteClients($ids);
        redirect(lang_url('user/clients'));
    }

    private function setClient()
    {
        $isValid = $this->validateClient();
        if ($isValid === true) {
            $_POST['editId'] = $this->editId;
            $this->NewInvoiceModel->setClient($_POST);
            $this->saveHistory('Add client - ' . $_POST['client_name']);
            redirect(lang_url('user/clients'));
        } else {
            $this->session->set_flashdata('resultAction', $isValid);
            if ($this->editId > 0) {
                redirect(lang_url('user/client/edit/' . $this->editId));
            } else {
                redirect(lang_url('user/client/add'));
            }
        }
    }

    private function validateClient()
    {
        $errors = array();
        if (mb_strlen(trim($_POST['client_name'])) == 0) {
            $errors[] = lang('err_create_client_name');
        }
        if (mb_strlen(trim($_POST['client_address'])) == 0) {
            $errors[] = lang('err_create_client_addr');
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

    public function deleteClient($id)
    {
        $this->ClientsModel->deleteClient($id);
        redirect(lang_url('user/clients'));
    }

    public function viewClient($id)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime').lang('title_preview_client');
        $result = $this->ClientsModel->getClientInfo($id);
        if (empty($result)) {
            log_message('error', 'User with id - ' . USER_ID . ' get 404 when try to view client with id -' . $id);
            show_404();
        }
        $data['clientInfo'] = $result;
        $this->render('clients/viewclient', $head, $data);
        $this->saveHistory('View client ' . $id);
    }

}
