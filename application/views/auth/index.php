<?php
    echo form_open('auth/login', ['class' => 'form-signin']);
    echo $error;
    $this->session->unset_userdata('error');
?>
<h2 class="form-signin-heading text-center">Chat App</h2>
<table class="table table-bordered">
  <tbody>
      <tr>
          <td>Username</td>
          <td>
            <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
          </td>
      </tr>
      <tr>
          <td>Password</td>
          <td>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </td>
      </tr>
  </tbody>
</table>
<button class="btn btn-md btn-primary" style="width:50%" name="submit" type="submit">Login</button> 
<?php echo anchor('auth/register', 'Register', ['class' => 'btn btn-md btn-info','style' =>'width: 11%;
    position: absolute; ']); ?>
<?php
    echo form_close();
?>