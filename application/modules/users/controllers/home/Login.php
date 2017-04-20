<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends ADMIN_Controller
{

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Login';
        if ($this->session->userdata('logged_in')) {
            redirect('admin/home');
        } else {
            if (isset($_POST['username'])) {
                $result = $this->GeneralAdminModel->loginCheck($_POST);
                if (!empty($result)) {
                    $result['image'] = 'assets/admin/imgs/no-profile-image.jpg';
                    if (is_file('attachments/adminsprofileimages/' . $result['image'])) {
                        $result['image'] = 'attachments/adminsprofileimages/' . $result['image'];
                    }
                    $_SESSION['logged_user_info'] = $result;
                    $this->session->set_userdata('logged_in', $result['username']);
                    $this->saveHistory('Logged in');
                    redirect('admin/home');
                } else {
                    $this->saveHistory('Cant login with - username: ' . $_POST['username'] . ' and password: ' . $_POST['password']);
                    $this->session->set_flashdata('err_login', 'Invalid username or password!');
                    redirect('admin');
                }
            }
        }
        $this->load->view('parts/login/header', $head);
        $this->load->view('home/login', $data);
        $this->load->view('parts/login/footer');
    }

    public function logOut()
    {
        $this->saveHistory('Logout in');
        $this->session->sess_destroy();
        redirect('admin');
    }

}
