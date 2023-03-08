<?php

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('auth_model');
        if (!$this->auth_model->current_user()) {
            redirect('backend/auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'List Data User';
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $data['users'] = $this->Users_model->get_all(); //menampilkan data

        $this->load->view('backend/list_users', $data);
    }
    public function delete($id = null)
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $this->Users_model->delete($id);
        redirect("backend/Users");
    }

    public function add()
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan data dari user login
        $data['users'] = $this->Users_model->get_all();
        if ($this->input->method() === 'post') {
            $users = [
                'nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'level' => $this->input->post('level'),
                'status' => $this->input->post('status')
            ];
            $saved = $this->Users_model->save($users);

            if ($saved) {
                $this->session->set_flashdata('message', 'Data berhasil disimpan!');
                return redirect('backend/Users');
            }
        }
        $this->load->view('backend/componen/add_users', $data);
    }

    public function edit($id = null)
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $data['users'] = $this->Users_model->find($id);

        if (!$data['users'] || !$id) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            // TODO: lakukan validasi data seblum simpan ke model
            $user = [
                'id_user' => $id,
                'username' => $this->input->post('username'),
                'nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'level' => $this->input->post('level'),
                'status' => $this->input->post('status')


            ];
            $updated = $this->Users_model->update($user);
            if ($updated) {
                $this->session->set_flashdata('message', 'Article was updated');
                redirect('backend/users');
            }
        }

        $this->load->view('backend/componen/edit_user', $data);
    }
    public function new()
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan data dari user login
        $data['users'] = $this->Users_model->get_all();
        if ($this->input->method() === 'post') {
            $users = [
                'username' => $this->input->post('username'),
                'nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'level' => $this->input->post('level'),
                'status' => $this->input->post('status')

            ];
            $saved = $this->Users_model->save($users);

            if ($saved) {
                $this->session->set_flashdata('message', 'Data berhasil disimpan!');
                return redirect('backend/users');
            }
        }
        $this->load->view('backend/componen/add_users', $data);
    }
}
