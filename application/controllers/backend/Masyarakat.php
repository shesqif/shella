<?php

class Masyarakat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Masyarakat_model');
        $this->load->model('auth_model');
        if (!$this->auth_model->current_user()) {
            redirect('backend/auth/login');
        }
    }
    public function index()
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level masyarakat
        $data['masyarakat'] = $this->Masyarakat_model->get_all(); //menampilkan list data masyarakat

        $this->load->view('backend/list_masyarakat', $data);
    }
    public function blokir()
    {
        $id = $this->uri->segment(4);
        $data = array('status'  => '0');
        $update = $this->Masyarakat_model->update_masyarakat(array('id_masyarakat' => $id), $data);
        $this->session->set_flashdata('gagal', '<div class="alert alert-success" role="alert">
            Data Petugas Telah Dinon-aktif!
          </div>');
        redirect('backend/masyarakat');
    }
    public function aktifkan()
    {
        $id = $this->uri->segment(4);
        $data = array('status'  => '1');
        $update = $this->Masyarakat_model->update_masyarakat(array('id_masyarakat' => $id), $data);
        $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">
            Data Petugas Telah Di-aktifkan kembali!
          </div>');
        redirect('backend/masyarakat');
    }
}
