<h1>Chatting App</h1>

<table border="1">
  <tr>
    <td>
      <div id="chat_viewport">
  
      </div>
    </td>
  </tr>
  <tr>
    <td style = "text-align: center;">
      <div id="chat_input">
        <input type="text" name="chat_message" id="chat_message" />
        <?php echo anchor('#', 'Enter', array('title' => 'Send this chat message', 'id' => 'submit_message', 'class' => 'btn btn-success btn-md')); ?>
        <div class="clearer"></div>
      </div>
    </td>
  </tr>
</table>
<br/>
<?php echo anchor('dashboard', 'Back', ['class' => 'btn btn-danger btn-md btn-block','style' => 'width: 90px']); ?>

