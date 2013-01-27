<?php


class Login extends CI_Controller {

    public function  __construct() {
        parent::__construct();
        $this->load->helper('form');

    }

    public function index() {

        $data = array(
            'title' => 'Login form',
            'header' => 'header',
            'content' => 'login-view',
            'footer' => 'footer'
        );

        $this->load->view('admin/login/login-template', $data);

    }

    public function validate() {


        $error = false;
        $ok = false;
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $message = "Wrong username or password!";

        if (!ctype_alnum($username)) {
            $message = "Username should contain only characters!";
            $error = true;
        }

        if (!ctype_alnum($password)) {
            $message = "Password should contain only alphanumeric characters!";
            $error = true;
        }

        if (!$error) {
            $this->load->model('admin/user_model');
            $ok = $this->user_model->validate($username, $password);
        }

        if ($ok) {

            $data = array(
                'username' => $username,
                'is_logged_in' => true
            );

            $redirect = base_url() . "admin/main/";
            $this->session->set_userdata($data);
            $arr = array ('redirect' => $redirect);

        } else {
            $arr = array ('form' => "$message");
        }

        echo json_encode($arr);
        die();

    }

    public function signout() {
        $data = array(
                'username' => '',
                'is_logged_in' => false
        );
        $this->session->unset_userdata($data);
        redirect(site_url() . '/admin/login/');
    }

}