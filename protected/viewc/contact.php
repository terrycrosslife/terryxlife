<?php $this->renderc('template/header'); ?> 
<link rel="stylesheet" href="global/css/green_form.css" type="text/css" media="screen" />
<script type="text/javascript" src="global/js/v/contact.js"></script>
</head>
<body>
  <div id="loader"></div>
  <div id="header">
    <div id="logo"></div>
    <div id="navbar">
      <a href="home" id="home">Home</a>
      <a href="contact" id="contact" class="active">Contact</a>
      <a href="about" id="about">About</a>
      <a href="#" id="resource">Resources</a>
      <a href="#" id="login_link">Login</a>
    </div>
    <div class="clear"></div>
  </div>
  <div id="wrapper">
    <div id="sidebar">

    </div>
    <div id="content">
      <div id="progress"></div>
      <div id="login">
        <form id="login_form" class="green_form">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" /><br>
          <label for="password">Password</label>
          <input type="password" id="password" name="password" /><br>
          <input type="submit" value="Login" /> or <a href="#">Join Us</a>
        </form>
      </div>
      <div id="login_message"></div>
      <div class="clear"></div>



      Welcome to my website


      <?php $this->renderc('template/footer'); ?>