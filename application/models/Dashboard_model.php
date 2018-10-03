<?php

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $this->db->select('*');
        $this->db->from('chats');
        return $this->db->get();
    }

   

}