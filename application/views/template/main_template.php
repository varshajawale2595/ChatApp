<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Chat</title>
    
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/'; ?>jquery.min.js"></script>

    <!-- User declared javascript for chat app -->
    <script type="text/javascript">
      var chat_id = "<?php echo $chat_id; ?>";
      var user_id = "<?php echo $user_id; ?>";
    </script>

    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/'; ?>chat.js"></script>
  
    <!-- Simple WebRTC JS -->
    <script src="<?php echo base_url() ?>assets/js/latest-v2.js"></script>
    
    <!-- Camera CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/camera.css">
    
    <?php
    $link = 'assets/css/chat.css';
    ?>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . $link; ?>">

    <script type="text/javascript">
      var base_url = "<?php echo base_url(); ?>";
    </script>
    <!-- End declaration -->

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url(); ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo base_url(); ?>assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <div style="width:100%" >
  <table style="width:100%">
  <tr>
  <td><h3 style="padding-left: 70px;"><?php echo 'Welcome  '; echo $this->session->userdata('first_name'); ?></h3></td> 
  <td class="text-right"><h3 style="padding-right: 75px;"><?php echo anchor('auth/logout', 'Logout'); ?></h3></td>
  </tr>
  </table>
  </div>

    <!-- Fixed navbar -->
    
    <div class="container theme-showcase" role="main">
      <?php echo $contents; ?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"><\/script>')</script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
