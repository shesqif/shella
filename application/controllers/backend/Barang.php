<?php

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model');
        $this->load->model('gambar_model');
        $this->load->model('auth_model');
        if (!$this->auth_model->current_user()) {
            redirect('backend/auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'List Data Barang';
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $data['barang'] = $this->barang_model->get_all(); //menampilkan data

        $this->load->view('backend/list_barang', $data);
    }

    public function delete($id = null)
    {
        $data['title'] = 'List Data Barang';
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $this->gambar_model->delete($id);
        $this->barang_model->delete($id);
        $this->session->set_flashdata('message', 'Data berhasil dihapus');
        redirect("backend/Barang");
    }

    public function add()
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $barang = $this->barang_model;
        $validation = $this->form_validation;
        $validation->set_rules($barang->rules());
        if ($validation->run()) {
            $barang->save();
            redirect("backend/Barang");
        }
        $this->load->view('backend/componens/add_barang', $data);
    }
    public function new()
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan data dari user login
        if ($this->input->method() === 'post') {
            $ori_name                        = $_FILES["gambar"]["name"];
            $file_name                        = uniqid('', true);
            $config['upload_path']            = FCPATH . '/upload/barang/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['file_name']            = str_replace('.', '', $file_name);
            $config['overwrite']            = true;
            $config['max_size']                = 1024; //1mb
            $config['max_width']            = 1080;
            $config['max_height']            = 1080;
            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('gambar')) {
                $data['error'] = $this->upload->display_errors();
                $this->session->set_flashdata('message', $data['error']);
            } else {
                $barang = [
                    'nama_barang' => $this->input->post('nama_barang'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'harga_awal' => $this->input->post('harga_awal')
                ];
                $saved = $this->barang_model->insert($barang);

                if ($saved) {
                    $uploaded_data = $this->upload->data();
                    $gambar = [
                        'id_barang' => $saved,
                        'gambar' => $uploaded_data['file_name'],
                        'nama_gambar' => $ori_name,
                        'utama' => 1,
                        'urutan' => 0
                    ];
                    $savedGambar = $this->gambar_model->insert($gambar);

                    if ($savedGambar) {
                        $this->session->set_flashdata('message', 'Data berhasil disimpan!');
                        return redirect('backend/barang');
                    } else {
                        $this->session->set_flashdata('message', 'Data gagal disimpan!');
                    }
                }
            }
        }
        $this->load->view('backend/componen/add_barang', $data);
    }
    public function edit($id = null)
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $data['barang'] = $this->barang_model->find($id);

        if (!$data['barang'] || !$id) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            // TODO: lakukan validasi data seblum simpan ke model
            $barang = [
                'id_barang' => $id,
                'nama_barang' => $this->input->post('nama_barang'),
                'deskripsi' => $this->input->post('deskripsi'),
                'status' => $this->input->post('status'),
                'harga_awal' => $this->input->post('harga_awal')
            ];
            $updated = $this->barang_model->update($barang);
            if ($updated) {
                $this->session->set_flashdata('message', 'Article was updated');
                redirect('backend/barang');
            }
        }

        $this->load->view('backend/componen/edit_barang', $data);
    }
}
