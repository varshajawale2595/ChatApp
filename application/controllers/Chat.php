<?php

class Chat extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();

        $this->load->model(['Chat_model','User_model']);
        $this->chat = $this->Chat_model;
        $this->user = $this->User_model;
        
    }

   

     public function index()
    {
        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(3);
            $chat_id = $this->uri->segment(3);
            $user_id = $this->session->userdata('user_id');
            $content = $data['upload_data']['file_name'];

            $data = [
               'chat_id' => $chat_id,
               'user_id' => $user_id,
               'content' => $content,
            ];

            $this->db->insert('chats_messages', $data);
            redirect('chat/index/'.$chat_id);
            
        } else {
            if (empty($chat_id = $this->uri->segment(3))) {
                $chat_id = $this->uri->segment(2);
            }
            $this->chat_component($chat_id);
        }
    }

    public function redirect()
    {
        $first_id = $this->uri->segment(3);
        $second_id = $this->uri->segment(4);
        $this->session->set_userdata('target_id', $second_id);

        $result = $this->chat->locate($first_id, $second_id);

        if ($result != 0) {
            redirect('chat/index/'. $this->session->userdata('chat_id'));
        } else {
            
            $topic = $first_id . $second_id;
            $chat = $this->chat->obtain($topic)->row_array();
            $data['first'] = $first_id;
            $data['second'] = $second_id;
            $data['topic'] = $topic;
            $segment = $this->chat->segment_create($data);
            echo $segment;
            if ($segment != 0) {
                redirect('chat/index/'. $segment);
            } else {
                echo "Error!!!";
                die();
            }
            $this->chat->segment_create();
        }
    }

    public function chat_component($chat_id)
    {
        $this->view_data['chat_data'] = $this->chat->getOne($chat_id)->row_array();
        $this->view_data['chat_id'] = $chat_id;
        $this->view_data['user_id'] = $this->session->userdata('user_id');

        $this->session->set_userdata('last_chat_message_id_' . $this->view_data['chat_id'], 0);

        $this->template->load('template/main_template', 'chat/index', $this->view_data);
    }
    
    public function ajax_add_chat_message()
    {
        $chat_id = $this->input->post('chat_id');
        $user_id = $this->input->post('user_id');
        $content = $this->input->post('content', true);

        $this->chat->add_chat_message($chat_id, $user_id, $content);

        echo $this->_get_chats_messages($chat_id);
    }

    public function ajax_get_chats_messages()
    {
        $chat_id = $this->input->post('chat_id');
        echo $this->_get_chats_messages($chat_id);
    }

    public function _get_chats_messages($chat_id)
    {
        $last_chat_message_id = (int) $this->session->userdata('last_chat_message_id_' . $chat_id);
        $chats_messages = $this->chat->get_chats_messages($chat_id, $last_chat_message_id);

        if ($chats_messages->num_rows() > 0) {
            $base_url = base_url();
            
            $last_chat_message_id = $chats_messages->row($chats_messages->num_rows() - 1)->id;

            $this->session->set_userdata('last_chat_message_id_' . $chat_id, $last_chat_message_id);

            $chats_messages_html = "<ul>";

            foreach ($chats_messages->result() as $chats_messages) {
                $record = $this->db->get_where('users', ['id' => $chats_messages->user_id])->row_array();
               

                $li_class = ($this->session->userdata('user_id') == $chats_messages->user_id) ?
                    'class="by_current_user"' : '';

               $chats_messages_html .= '<p>
                        <li ' . $li_class . '>'
                        .'<span class="chat_message_header"><b>'
                        . $chats_messages->timestamp
                        . ' by '
                        . $chats_messages->first_name 
                        . '</b></span> : 
                        <span class="message_content"> '
                        . $chats_messages->content
                        .'</span>
                        </li></p>';
                
               
            }

            $chats_messages_html .= "</ul>";

            $result = [
                'status'    => 'ok',
                'content'   => $chats_messages_html,
                'last_chat_message_id' => $last_chat_message_id
            ];

            return json_encode($result);
            exit();
        } else {
            $result = [
                'status'    => 'ok',
                'content'   => '',
                'last_chat_message_id' => $last_chat_message_id
            ];

            return json_encode($result);
            exit();
        }
    }
}
