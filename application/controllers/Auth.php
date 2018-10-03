<?php

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model(['Auth_model', 'User_model']);

        $this->auth = $this->Auth_model;
        $this->user = $this->User_model;
    }

    public function index()
    {
        redirect('auth/login');
    }

    public function welcome()
    {
        $this->template->load('template/welcome_template', 'welcome/index');
    }

    public function login()
    {
        if (isset($_POST['submit']))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $verify = $this->auth->verify($username, $password);

            if ($verify == 1) {
                $this->session->set_userdata('login_status', 'ok');
                $this->user->logged($this->session->userdata('user_id'));
                redirect('dashboard');
            } else {
                $this->session->set_userdata(['error' => 'Error!! Invalid Username or Password !!']);
                redirect('auth/login');
            }
        } elseif (isset($_POST['submit_register'])) {
            redirect('auth/register');
        } else {
            $data['error'] = $this->session->userdata('error');
            $this->template->load('template/login_template', 'auth/index', $data);
        }
    }
    
    public function register()
    {
        if (isset($_POST['submit'])) {

            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            
            $this->db->insert('users', $data);
            
            redirect('auth');
        } else {
            $this->template->load('template/login_template', 'register/index');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/index');
    }
}
