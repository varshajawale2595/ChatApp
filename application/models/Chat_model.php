<?php

class Chat_model extends CI_Model 
{
   
    public function __construct()
    {
        parent::__construct();
    }

    public function create($first_id, $second_id)
    {
        $data['topic'] = $first_id . $second_id;
        $data['first'] = $first_id ;
        $data['second'] = $second_id;
        
        $chat = $this->db->insert('chats', $data);

        if ($chat) {
            return 1;
        } else {
            return 0;
        }
    }

    public function add_chat_message($chat_id, $user_id, $content)
    {
        $query = "INSERT INTO chats_messages (chat_id, user_id, content) VALUES (?, ?, ?)";

        return $this->db->query($query, array($chat_id, $user_id, $content));
    }

    public function get_chats_messages($chat_id, $last_chat_message_id = 0)
    {
        $query = "SELECT
                    cm.id,
                    cm.user_id,
                    cm.content,
                    DATE_FORMAT(cm.created_at, '%d-%m-%y at %H:%i') AS timestamp,
                    u.email,
                    u.first_name,
                    u.last_name
                FROM
                    chats_messages AS cm
                JOIN
                    users AS u
                ON
                    cm.user_id = u.id
                WHERE 
                    cm.chat_id = ?
                AND 
                    cm.id > ?
                ORDER BY
                    cm.id
                ASC";

        $result = $this->db->query($query, [$chat_id, $last_chat_message_id]);

        return $result;
    }

    public function getOne($id)
    {
        return $this->db->get_where('chats', ['id' => $id]);
    }

    public function get()
    {
        $this->db->select('chats.*, users.username');
        $this->db->from('chats as chats, users as users');
        $this->db->where('chats.user_id = users.id');
        return $this->db->get();
    }

    public function obtain($topic)
    {
        return $this->db->get_where('chats', ['topic' => $topic]);
    }

    public function segment_create($data)
    {
        $segment = $this->db->insert('chats', $data);

        if ($segment) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function locate($first_id, $second_id)
    {
        $query = "SELECT
                    *
                FROM
                    chats AS uri
                WHERE
                    (first = '$first_id'
                AND
                    second = '$second_id')
                OR
                    (first = '$second_id'
                AND
                    second = '$first_id')
                ORDER BY
                    uri.id
                DESC";

        $record_array = $this->db->query($query)->row_array();
        $this->session->set_userdata(['chat_id' => $record_array['id']]);

        $result = $this->db->query($query)->num_rows();

        if ($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }

}
