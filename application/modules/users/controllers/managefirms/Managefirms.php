<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Managefirms extends USER_Controller
{

    private $myFirms;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ManagefirmsModel', 'HomeModel'));
    }

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_manage_firms');
        $data['firms'] = $this->myFirms = $this->HomeModel->getFirms();
        if (isset($_POST['firm_name'])) {
            if (count($this->myFirms) < $this->planUnits['num_firms']) { // if num my firms is lower than my plan num allowed
                $result = $this->validateCompanyDetails();
                if ($result === true) {
                    $companyId = $this->setFirm();
                    $this->addCompanyFolders($companyId);
                    $this->saveHistory('Add company - ' . print_r($_POST, true));
                    $this->session->set_flashdata('resultAction', lang('company_added'));
                } else {
                    $this->session->set_flashdata('addFirm', '1');
                    $this->session->set_flashdata('resultAction', $result);
                }
                redirect(lang_url('user/managefirms'));
            }
        }
        $this->render('managefirms/index', $head, $data);
        $this->saveHistory('Go to manage firms page');
    }

    public function deleteCompany($companyId)
    {
        if (!in_array($companyId, $this->canUseFirms)) {
            log_message('error', 'User with id - ' . USER_ID . ' get 404 when try to delete company with id -' . $companyId);
            show_404();
        }
        $this->ManagefirmsModel->deleteCompany($companyId);
        if ($companyId == SELECTED_COMPANY_ID) {
            $lastAddedCompanyId = $this->ManagefirmsModel->getLastAddedCompanyId();
            if ($lastAddedCompanyId != null) {
                redirect(lang_url('user/usecompany/' . $lastAddedCompanyId));
            }
        }
        $this->session->set_flashdata('resultAction', lang('company_deleted'));
        $this->saveHistory('Delete company id - ' . $companyId);
        redirect(lang_url('user/managefirms'));
    }

    public function editCompany($companyId, $translateId = 0)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('title_everytime') . lang('title_edit_firm');
        if (!in_array($companyId, $this->canUseFirms)) {
            log_message('error', 'User with id - ' . USER_ID . ' get 404 when try to edit company with id -' . $companyId . ' No permissions!');
            show_404();
        }
        $result = $this->getCompanyInfo($companyId);
        if (empty($result['company']) || !is_numeric($companyId)) {
            log_message('error', 'User with id - ' . USER_ID . ' get 404 when try to edit company with id -' . $companyId . ' Not found this id or is not numeric searched for id');
            show_404();
        }
        if ($translateId > 0) {
            $companyTranslate = $this->ManagefirmsModel->getTranslationInfo($translateId, $companyId);
            if (empty($companyTranslate)) {
                show_404();
            }
            $data['companyTranslate'] = $companyTranslate;
        } else {
            $data['companyTranslate'] = $this->ManagefirmsModel->getMyCompanyDefaultTranslation($companyId);
        }
        /*
         * Save Bulstat Data
         */
        if (isset($_POST['firm_bulstat'])) {
            $result = $this->updateCompanyStaticInfo($companyId);
            if ($result === false) {
                $this->session->set_flashdata('resultAction', lang('bulstat_is_taken'));
            } else {
                $this->saveHistory('Update firm details for Id - ' . $companyId);
                $this->session->set_flashdata('resultAction', lang('firm_details_changed'));
            }
            redirect(lang_url('user/managefirms/edit/' . $companyId));
        }
        /*
         * Save Translation texts
         */
        if (isset($_POST['saveTranslate'])) {
            $this->updateTranslation($companyId);
            $this->saveHistory('Update translation for company Id - ' . $companyId);
            $this->session->set_flashdata('resultAction', lang('translation_updated'));
            redirect(lang_url('user/managefirms/edit/' . $companyId . '/' . $translateId));
        }
        /*
         * Add new translation
         */
        if (isset($_POST['add_new_translation'])) {
            $result = $this->addNewTranslation($companyId);
            if ($result === true) {
                $this->saveHistory('Add new translation for company Id - ' . $companyId);
                $this->session->set_flashdata('resultAction', lang('new_translation_added'));
            } else {
                $this->session->set_flashdata('addNewTranslationErr', '1');
                $this->session->set_flashdata('resultAction', $result);
            }
            redirect(lang_url('user/managefirms/edit/' . $companyId));
        }
        $data['companyInfo'] = $result;
        $this->render('managefirms/edit', $head, $data);
        $this->saveHistory('Go to edit firms id - ' . $companyId);
    }

    public function deleteTranslation($companyId, $translationid)
    {
        $this->ManagefirmsModel->deleteTranslation($companyId, $translationid);
        $this->session->set_flashdata('resultAction', lang('translation_deleted'));
        $this->saveHistory('Delete tanslation id - ' . $translationid);
        redirect(lang_url('user/managefirms/edit/' . $companyId));
    }

    public function makeDefaultTranslation($companyId, $translationId)
    {
        $this->ManagefirmsModel->makeDefaultTranslationWithId($companyId, $translationId);
        $this->saveHistory('Make default tanslation id - ' . $translationid);
        redirect(lang_url('user/managefirms/edit/' . $companyId));
    }

    public function makeDefaultFirm($firmId)
    {
        $this->ManagefirmsModel->makeDefaultFirmWithId($firmId);
        $this->saveHistory('Make default company id - ' . $firmId);
        redirect(lang_url('user/managefirms'));
    }

    private function addNewTranslation($companyId)
    {
        $errors = $this->validateCompanyDetails(false);
        $img = uploader('./attachments/' . COMPANIES_IMAGES_DIR . '/' . $companyId);
        if (isset($img['result']) && $img['result'] === true) {
            $_POST['image'] = $img['value'];
        } elseif (!isset($img['result']) && $img === false) {
            $_POST['image'] = '';
        } elseif (isset($img['result']) && $img['result'] === false) {
            $errors[] = lang('upload_img_error') . $img['value'];
        }
        if ($errors === true) {
            $this->ManagefirmsModel->setNewTranslation($_POST, $companyId);
            return true;
        } else {
            return $errors;
        }
    }

    private function updateTranslation($companyId)
    {
        $errors = $this->validateCompanyDetails(false);
        $img = uploader('./attachments/' . COMPANIES_IMAGES_DIR . '/' . $companyId);
        if (isset($img['result']) && $img['result'] === true) {
            $_POST['image'] = $img['value'];
        } elseif (!isset($img['result']) && $img === false) {
            $_POST['image'] = $_POST['old_image'];
        } elseif (isset($img['result']) && $img['result'] === false) {
            $errors[] = lang('upload_img_error') . $img['value'];
        }
        if ($errors === true) {
            $result = $this->ManagefirmsModel->updateTranslation($_POST, $companyId);
            return $result;
        } else {
            return $errors;
        }
    }

    private function updateCompanyStaticInfo($companyId)
    {
        $result = $this->HomeModel->checkBulstatIsFree($_POST['firm_bulstat'], $companyId);
        if ($result === true) {
            $this->ManagefirmsModel->updateCompanyStaticInfo($_POST, $companyId);
        }
        return $result;
    }

    private function getCompanyInfo($companyId)
    {
        $result = $this->ManagefirmsModel->getCompanyInfo($companyId);
        return $result;
    }

    private function setFirm()
    {
        $_POST['is_default'] = 0;
        $companyId = $this->HomeModel->setFirm($_POST);
        return $companyId;
    }

}
