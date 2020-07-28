<?php session_start() ; ?>
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
        if (!isset($_SESSION["user"])){
          echo '<a href='.MAIN.'login>Login</a>' ;
        }
        else{
          echo '<a href='.MAIN.'login/logout>Logout</a>' ;
        }
      ?>
      <a href=<?php echo MAIN."signup" ; ?>>Signup</a>
    </header>
    <div class="main">