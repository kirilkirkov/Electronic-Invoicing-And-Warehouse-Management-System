<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

    private $blogLimit = 5;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $head = array();
		$head['title'] = lang('title_home');
		$head['description'] = lang('description_home'); 
        $this->render('home/index', $head, $data);
    }

    public function logout()
    {
        unset($_SESSION['user_login']);
        unset($_SESSION['selected_company']);
        redirect(lang_url());
    }

    /*
     * Called from HtmlToPdf library to load footer for invoices
     * wkhtmltopdf cant call files for footer/header :(
     */

    public function getInvoiceFooter()
    {
        if (!isset($_GET['num'])) {
            log_message('error', 'Call footer for wkhtmltopdf without GET[num] variable - ' . print_r($_SESSION['user_login'], true));
            exit;
        }
        $data = array();
        $data['num'] = $_GET['num'];
        $data['type'] = $_GET['type'];
        $data['pageTranslate'] = urldecode($_GET['pageTranslate']);
        $this->load->view('invoices_parts/footer.php', $data);
    }

    public function publicAcceptInvoice($uniqid)
    {
        $data = array();

        $arr = explode('u', $uniqid);
        if (!isset($arr[0]) || !is_numeric($arr[0])) {
            show_404();
        }

        $userId = $arr[0];
        $row = $this->PublicModel->getInvoiceForAccept($userId, $uniqid);
        if (empty($row)) {
            log_message('error', 'Try to accept not available invoice with uniqid - ' . $uniqid);
            show_404();
        }

        $invoice = modules::run('users/invoices/invoiceview/getInvoiceByNumber', $row['inv_type'], $row['inv_number']);
        if ($invoice == null) {
            show_404();
        }

        if (isset($_POST['action']) && ($_POST['action'] == 'accepted' || $_POST['action'] == 'refused')) {
            modules::run('users/invoices/invoices/changeInvoiceStatus', $invoice['id'], $_POST['action']);
            if ($_POST['action'] == 'accepted') {
                $action = 'accepted';
                $info = '';
            } else {
                $action = 'refused';
                $info = $_POST['refuse_reason'];
            }
            $this->PublicModel->setInvoiceLog($invoice['id'], $action, $info);
            redirect(base_url('accept/invoice/' . $invoice['uniqid']));
        }

        $template = $this->PublicModel->getOneValueStore('opt_invTemplate', $userId);

        $templates = $this->config->item('templates');
        if (!in_array($template, $templates)) {
            $template = $templates[0];
        }

        $templatesDir = 'application/modules/users/views/invoices/templates/';
        $templateFile = $templatesDir . $template . '.php';
        if (!is_file($templateFile)) {
            show_error(lang('no_template_file'));
        }
        $data['templateFile'] = $templateFile;
        $data['invoice'] = $invoice;
        $data['origin'] = 'original';
        $this->load->view('parts/invaccept/header');
        $this->load->view('invoices_parts/invoice_accept', $data);
        $this->load->view('parts/invaccept/footer');
    }

}
