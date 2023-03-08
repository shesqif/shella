<?php

class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('lelang_model');
        $this->load->model('penawaran_model');
        $this->load->model('masyarakat_model');
        $this->load->model('gambar_model');
        $this->load->model('authfront_model');
    }

    public function index()
    {
        $data['activeUser'] = $this->authfront_model->current_user();
        $data['dashboard'] = $this->lelang_model->get_pepet();
        $data['lelang'] = $this->lelang_model->get_LelangBerlangsung();
        $this->load->view('partials/header');
        $this->load->view('partials/sidenav', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('partials/footer');
    }

    public function login()
    {
        $data['activeUser'] = $this->authfront_model->current_user();
        if ($data['activeUser']) {
            show_404();
        }
        if ($this->input->method() === 'post') {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($this->authfront_model->login($email, $password)) {
                $this->session->set_flashdata('message', 'Login berhasil!');
                redirect();
            } else {
                $this->session->set_flashdata('error', 'Login Gagal, pastikan email dan password benar!');
            }
        }
        $this->load->view('login_front', $data);
    }

    public function register()
    {
        $data['activeUser'] = $this->authfront_model->current_user();
        if ($data['activeUser']) {
            show_404();
        }
        if ($this->input->method() === 'post') {
            $email = $this->input->post('email');
            $is_exists = $this->masyarakat_model->get_by_user($email)->row();
            if ($is_exists) {
                $this->session->set_flashdata('message', 'Email sudah terdaftar sebelumnya!');
            } else {
                $masyarakat = [
                    'email'  => $this->input->post('email'),
                    'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'nik'       => $this->input->post('nik'),
                    'nama'      => $this->input->post('nama'),
                    'jk'        => $this->input->post('jk'),
                    'no_hp'     => $this->input->post('no_hp'),
                    'alamat'    => $this->input->post('alamat')
                ];
                $saved = $this->masyarakat_model->insert($masyarakat);

                if ($saved) {
                    $this->session->set_flashdata('message', 'Registrasi berhasil! Silahkan login untuk melanjutkan.');
                    return redirect('page/login');
                }
            }
        }
        $this->load->view('register', $data);
    }

    public function logout()
    {
        $this->authfront_model->logout();
        redirect();
    }

    public function edit()
    {
        $data['activeUser'] = $this->authfront_model->current_user();
        if (!$data['activeUser']) {
            show_404();
        }
        $data['masyarakat'] = $this->masyarakat_model->get_by_id($data['activeUser']->id_masyarakat);
        if (!$data['masyarakat']) {
            show_404();
        }
        if ($this->input->method() === 'post') {
            $masyarakat = [
                'id_masyarakat'  => $data['activeUser']->id_masyarakat,
                'nik'       => $this->input->post('nik'),
                'nama'      => $this->input->post('nama'),
                'jk'        => $this->input->post('jk'),
                'no_hp'     => $this->input->post('no_hp'),
                'alamat'    => $this->input->post('alamat')
            ];
            $update = $this->masyarakat_model->update($masyarakat);
            if ($update) {
                $this->session->set_flashdata('message', 'Data berhasil diubah!');
                return redirect($this->uri->uri_string());
            } else {
                $this->session->set_flashdata('message', 'Data gagal diubah!');
            }
        }
        $this->load->view('edit_masyarakat', $data);
    }
    public function get_pemenangLelang()
    {
        $query = $this->db->get_where($this->_vPemenangLelang, array('status' => 'Unconfirmed'));
        return $query->result();
    }

    public function change()
    {
        $data['activeUser'] = $this->authfront_model->current_user();
        if (!$data['activeUser']) {
            show_404();
        }
        $data['masyarakat'] = $this->masyarakat_model->get_by_id($data['activeUser']->id_masyarakat);
        if (!$data['masyarakat']) {
            show_404();
        }
        if ($this->input->method() === 'post') {
            $current = $this->input->post('current');
            $verify = $this->masyarakat_model->verify($data['activeUser']->email, $current);
            if (!$verify) {
                $this->session->set_flashdata('message', 'Current password salah!');
            } else {
                $masyarakat = [
                    'id_masyarakat'  => $data['activeUser']->id_masyarakat,
                    'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
                ];
                $update = $this->masyarakat_model->update($masyarakat);
                if ($update) {
                    $this->session->set_flashdata('message', 'Password berhasil diubah. Silahkan login kembali!');
                    $this->logout();
                    redirect();
                } else {
                    $this->session->set_flashdata('message', 'Password gagal diubah!');
                }
            }
        }
        $this->load->view('change_password', $data);
    }

    public function penawaran()
    {
        $data['activeUser'] = $this->authfront_model->current_user();
        if (!$data['activeUser']) {
            show_404();
        }
        $data['penawaran'] = $this->penawaran_model->get_by_penawar($data['activeUser']->id_masyarakat);
        $this->load->view('riwayat_penawaran', $data);
    }

    public function delete_penawaran($id_penawaran = null)
    {
        $data['activeUser'] = $this->authfront_model->current_user();
        if (!$data['activeUser']) {
            show_404();
        }
        $data['penawaran'] = $this->penawaran_model->get_by_id($id_penawaran)->row();
        if (!$data['penawaran'] || $data['penawaran']->id_masyarakat <> $data['activeUser']->id_masyarakat) {
            show_404();
        }
        $deleted = $this->penawaran_model->delete($id_penawaran);
        if ($deleted) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
            redirect('page/penawaran');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus!');
        }
        $this->load->view('riwayat_penawaran', $data);
    }

    public function lelang()
    {
        $data['activeUser'] = $this->authfront_model->current_user();
        $data['pemenang'] = $this->lelang_model->get_pemenangLelang($data['activeUser']->id_masyarakat);
        $this->load->view('pemenang_lelang', $data);
    }

    // public function berlangsung()
    // {
    //     // $data['title'] = 'List Data Lelang';
    //     $data['activeUser'] = $this->auth_model->current_user();
    //     $data['berlangsung'] = $this->lelang_model->get_all();
    //     $this->load->view('dashboard', $data);
    // }

    public function detail_lelang($id_lelang = null)
    {
        $data['activeUser'] = $this->authfront_model->current_user();
        $data['lelang'] = $this->lelang_model->berlangsung_by_id($id_lelang)->row();
        if (!$data['lelang'] || !$id_lelang) {
            show_404();
        }
        $data['penawaran'] = $this->penawaran_model->get_tawar_lelang($id_lelang);
        $data['gambar'] = $this->gambar_model->get_by_idBarang($data['lelang']->id_barang);
        if ($this->input->method() === 'post') {
            $harga_penawaran = $this->input->post('harga_penawaran');
            if ($harga_penawaran <= $data['lelang']->harga_tertinggi || $harga_penawaran < $data['lelang']->harga_awal) {
                $this->session->set_flashdata('message', 'Penawaran harus lebih besar dari harga awal atau tertinggi saat ini!');
            } else {
                $penawaran = [
                    'id_masyarakat'     => $data['activeUser']->id_masyarakat,
                    'id_lelang'         => $id_lelang,
                    'harga_penawaran'   => $harga_penawaran
                ];
                $update = $this->penawaran_model->insert($penawaran);
                if ($update) {
                    $this->session->set_flashdata('message', 'Penawaran berhasil dikirim!');
                    return redirect($this->uri->uri_string());
                } else {
                    $this->session->set_flashdata('message', 'Penawaran gagal dikirim!');
                }
            }
        }
        $this->load->view('detail_lelang', $data);
    }

    public function cari()
    {
        $keyword = $this->input->post('cari');
        if (empty($keyword)) {
            redirect();
        }
        $data['activeUser'] = $this->authfront_model->current_user();
        $data['lelang'] = $this->lelang_model->search($keyword);
        if (!$data['lelang']) {
            return $this->load->view('pg_notfound', $data);
        }
        $this->load->view('dashboard', $data);
    }
}
