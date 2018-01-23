<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Protocols extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProtocolsModel');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_protoc_sett');
        if (isset($_POST['title'])) {
            $this->setProviderTransmitText();
        }
        if (isset($_POST['contract'])) {
            $this->setContract();
        }
        $data['providerTransmits'] = $this->ProtocolsModel->getProviderTransmits();
        $data['contracts'] = $this->ProtocolsModel->getContracts();
        $this->render('settings/protocols', $head, $data);
        $this->saveHistory('Go to settings invoices page');
    }

    private function setProviderTransmitText()
    {
        $this->ProtocolsModel->setProviderTransmitText($_POST);
        $this->saveHistory('Add new provider transmit text - ' . $_POST['title']);
        redirect(lang_url('user/settings/protocols'));
    }

    public function deleteProviderTransmitText($id)
    {
        $this->ProtocolsModel->deleteProviderTransmitText($id);
        $this->saveHistory('Delete provider transmit text - ' . $id);
        redirect(lang_url('user/settings/protocols'));
    }

    private function setContract()
    {
        $this->ProtocolsModel->setContract($_POST);
        $this->saveHistory('Add new contract - ' . $_POST['title']);
        redirect(lang_url('user/settings/protocols'));
    }

    public function deleteContract($id)
    {
        $this->ProtocolsModel->deleteContract($id);
        $this->saveHistory('Delete contract text - ' . $id);
        redirect(lang_url('user/settings/protocols'));
    }

}
