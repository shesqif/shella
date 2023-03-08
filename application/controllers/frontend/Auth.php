<?php

class Auth extends CI_Controller
{
    public function index()
    {
        show_404();
    }

    public function login()
    {
        $this->load->model('authfront_model');
        $this->load->library('form_validation');

        $rules = $this->authfront_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            return $this->load->view('frontend/login_frontend');
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // echo $username;

        if ($this->authfront_model->login($username, $password)) {
            redirect('frontend');
        } else {
            $this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan passwrod benar!');
        }

        $this->load->view('frontend/login_frontend');
    }

    public function logout()
    {
        $this->load->model('authfront_model');
        $this->authfront_model->logout();
        redirect('frontend');
    }
}
