<h4>List Of Users</h4>
<br>

<table class="table table-bordered table-striped">
  <tr>
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Chat</th>
      </tr>
    </thead>
  </tr>
  <tbody>
    <?php
    $no = 0;
    $this->load->model('Chat_model');
    
    foreach ($record->result() as $r) {
        $no++;
        $name = $r->first_name.' '.$r->last_name;

        $isChat = $this->Chat_model->locate($this->session->userdata('user_id'),$r->id);
        if($isChat == 1){
          $chat_button = "Continue Chat";
        }else{
          $chat_button = "Start Chat";
        }
        
        echo "<tr>
          <td>$no</td>
          <td>$name</td>
          <td>". anchor('chat/redirect/'.$this->session->userdata('user_id').'/'.$r->id, $chat_button, ['class' => 'btn btn-success btn-sm']) ."</td>
        </tr>";
    }
    ?>
  </tbody>
</table>
</p>

<script src="<?php echo base_url(); ?>js/dashboard.js" type="text/javascript"></script>