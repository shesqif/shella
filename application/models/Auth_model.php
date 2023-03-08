<?php

class Auth_model extends CI_Model
{
    private $_table = "users";
    const SESSION_KEY = 'id_user';

    public function rules()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|max_length[100]'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|max_length[100]'
            ]
        ];
    }

    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('status', 1);
        $query = $this->db->get($this->_table);
        $users = $query->row();

        // cek apakah user sudah terdaftar?
        if (!$users) {
            return FALSE;
        }

        // cek apakah passwordnya benar?
        if (!password_verify($password, $users->password)) {
            return FALSE;
        }

        // bikin session
        $this->session->set_userdata([self::SESSION_KEY => $users->id_user]);

        return $this->session->has_userdata(self::SESSION_KEY);
    }

    public function current_user()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }

        $id_user = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where($this->_table, ['id_user' => $id_user]);
        return $query->row();
    }

    public function logout()
    {
        $this->session->unset_userdata(self::SESSION_KEY);
        return !$this->session->has_userdata(self::SESSION_KEY);
    }

    // private function _update_last_login($id)
    // {
    //     $data = [
    //         'last_login' => date("Y-m-d H:i:s"),
    //     ];

    //     return $this->db->update($this->_table, $data, ['id' => $id]);
    // }
}
