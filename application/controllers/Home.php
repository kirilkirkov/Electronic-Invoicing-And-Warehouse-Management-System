<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

    private $blogLimit = 5;

    public function index()
    {
        $data = array();
        $head = array();
        $data['last_articles'] = $this->PublicModel->lastInBlog($this->blogLimit);
        $this->render('home/index', $head, $data);
    }

    public function logout()
    {
        unset($_SESSION['user_login']);
        unset($_SESSION['selected_company']);
        redirect(base_url());
    }

    /*
     * Called from HtmlToPdf library to load footer for invoices
     * wkhtmltopdf cant call files for footer/header :(
     */

    public function getInvoiceFooter()
    {
        if (!isset($_GET['invNum'])) {
            log_message('error', 'Call footer for wkhtmltopdf without GET[invNum] variable - ' . print_r($_SESSION['user_login'], true));
            exit;
        }
        $data = array();
        $data['invNum'] = $_GET['invNum'];
        $data['invType'] = $_GET['invType'];
        $this->load->view('invoices_parts/footer.php', $data);
    }

}
