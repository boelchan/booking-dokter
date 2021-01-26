<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    
    
    
    
        <link href="<?php echo base_url(); ?>assets/login/style.css" rel="stylesheet" type="text/css" />

    
    
    
  </head>

  <body>
      <div class="login-page">
        <div class="form">
        <?php echo @$this->session->flashdata('msg'); ?>
          <form class="login-form" action="<?php echo site_url('auth/login_post') ?>" method="post">
            <input type="text" placeholder="username" name="username"/>
            <input type="password" placeholder="password" name="password"/>
            <button type="submit">login</button>
            <a href="<?php echo site_url('auth/daftar')?>">Daftar Pasien Baru ?</a>
            <p class="message"></p>
          </form>
        </div>
      </div>
    

        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/login/login.js" type="text/javascript"></script>

    
    
    
  </body>
</html>
