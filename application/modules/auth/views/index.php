<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>ERPlaning</title> 
   <link rel="stylesheet" href="<?php echo base_url()?>/assets/login/normalize.min.css">
   <link rel='stylesheet' href='<?php echo base_url()?>/assets/login/bootstrap.min.css'>
   <link rel="stylesheet" href="<?php echo base_url()?>/assets/login/css/style.css"> 
   <link rel="icon" href="<?php echo base_url()?>/assets/logo.png">
</head>

<body>

  
<div class="container main">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 text-center title">
      <h1>Want to Connect?</h1>
      <div class="bar"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 form">
      <h2>Login</h2>
      <center>
         <?php if($this->session->flashdata('login_error') OR form_error('username_username') == TRUE OR form_error('password') == TRUE) { ?>
            <div class="alert alert-danger">* Wrong password or username !</div>
        <?php } ?>
      </center>
      <form class="form-signin" method="post" action="<?php echo site_url('auth/proses');?>">
        <input type="text" name="username" placeholder="username"/><br/>
        <input type="password" name="password" placeholder="password"/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">login</button> 
    </div>
  </div>
</div>
  
  

</body>

</html>
