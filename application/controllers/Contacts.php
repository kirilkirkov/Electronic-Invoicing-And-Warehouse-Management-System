<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $head = array();
        if (isset($_POST['sendEmail'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $header = $_POST['header'];
            $message = $_POST['message'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL) && $message != '' && $this->session->userdata('spam') < 10) {
                $msg = "Name: $name\n"
                        . "Email: $email\n"
                        . "Domain: $header"
                        . "Message:\n$message";
                mail("support@pmticket.com", "Email from support page", $msg);
                $this->session->set_flashdata('success_send', lang('we_received'));
                redirect(lang_url('contacts'));
            } else {
                redirect(lang_url('contacts'));
            }
            if (!$this->session->userdata('spam')) {
                $this->session->set_userdata(array('spam' => 1));
            }
            $spam = $this->session->userdata('spam');
            $this->session->set_userdata(array('spam' => $spam + 1));
        }
        $head['title'] = 'Collaboration Software Support - 24/7';
        $head['description'] = 'Use pmTicket.com online for minimal price on the internet and get 24/7 support';
        $head['keywords'] = '24/7 support, pmTicket support, pmTicket online support';
        $this->render('contacts/index', $head, $data);
    }

}
