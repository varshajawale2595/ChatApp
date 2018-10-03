<?php

class Auth_model extends CI_Model
{
   
    public function verify($username, $password)
    {
        $user = $this->db->get_where('users', ['email' => $username, 'password' => $password]);

        $data = $user->row_array();
        $user_array = $user->row_array();

        if ($user->num_rows() > 0) {
            
                $this->session->set_userdata([
                    'user_id' => $data['id'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email']
                ]);
                return 1;
           } else {
            return 0;
        }
    }
}
