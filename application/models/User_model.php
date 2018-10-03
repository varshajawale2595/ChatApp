<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($user_id)
    {
        $this->db->select();
        $this->db->from('users as users');
        $this->db->where('users.id != ', $user_id);
        $this->db->where('users.id != 0');
        return $this->db->get();
    }

    public function getOne($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('users');
    }

    public function logged($user_id)
    { 
         return 1;
    }
}