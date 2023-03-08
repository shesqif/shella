<?php
defined('BASEPATH') or exit('no direct script acces allowed');
class Users_model extends CI_Model
{
    private $_table = 'users';
    public function rules()
    {
        return [
            [
                'field' => 'nip',
                'label' => 'nip',

            ],
            [
                'field' => 'nama',
                'label' => 'nama',

            ],
            [
                'field' => 'email',
                'label' => 'email',

            ],
            [
                'field' => 'no_hp',
                'label' => 'no_hp',

            ],
            [
                'field' => 'level',
                'label' => 'level',

            ],
            [
                'field' => 'status',
                'label' => 'status',

            ],
        ];
    }
    public function get_all() //Menampilkan list semua data users
    {
        $query = $this->db->get_where($this->_table); //data diambil dari table users
        return $query->result();
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_user" => $id));
    }
    public function save()
    { {
            $data = array(
                "password" => $this->input->post('password'),
                "nip" => $this->input->post('nip'),
                "nama" => $this->input->post('nama'),
                "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                "level" => $this->input->post('level'),
                "status" => $this->input->post('status')
            );
            return $this->db->insert($this->_table, $data);
        }
    }
    public function find($id_user)
    {
        if (!$id_user) {
            return;
        }

        $query = $this->db->get_where($this->_table, array('id_user' => $id_user));
        return $query->row();
    }

    public function update($user)
    {
        return $this->db->update($this->_table, $user, ['id_user' => $user['id_user']]);
    }

    function update_admin($where, $data)
    {
        $this->db->update('users', $data, $where);
        return $this->db->affected_rows();
    }
}
