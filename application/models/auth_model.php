<?php

class auth_model extends CI_model{
    
    public function cek_login($username, $password)
    {
        return $this->db->get_where('users',[
            'username'=>$username,
            'password'=>md5($password)
        ])->row();
    }

    public function update_last_login($id)
    {
        $this->db->where('id', $id);
        $this->db->update('users',[
            'last_login'=>date('Y-m-d H:i:s')
        ]);
    }
}