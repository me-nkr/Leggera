<?php 
  if (session_status() == PHP_SESSION_NONE) {
    
      session_start();
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-size=1.0">
    <title></title>
    <link rel="stylesheet" href="<?php echo CSS ; ?>style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo CSS.$this->viewName ; ?>.css" type="text/css" media="all" />
  </head>
  <body>
    <header class="header">
      <h1>MVC Project</h1> <br />
      <a href=<?php echo MAIN."index" ; ?> >Home</a>
      <?php

        if (isset($_SESSION["user"])){

          echo '<a href='.MAIN.'login/logout>Logout</a>' ;       
        }
      ?>
      <a href=<?php echo MAIN."signup" ; ?>>Signup</a>
      <a href=<?php echo MAIN."contact" ; ?>>Contact</a>
      <form method="post" action="login" accept-charset="utf-8">
        <input type="text" name="UserName" id="">
        <input type="password" name="PassWord" id="">
        <button type="submit" name="submitLogin">Submit</button>
      </form>
      <div class="errorlog">
  <?php

    if (isset($_SESSION["errorlog"])) {
      
      echo $_SESSION["errorlog"] ;

      session_unset() ;
      
      session_destroy() ;
    }
  ?>
</div>
    </header>
    <div class="main">