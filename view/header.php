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
    <title>Leggera</title>
    <link rel="stylesheet" href="<?php echo CSS ; ?>style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo CSS.$this->viewName ; ?>.css" type="text/css" media="all" />
  </head>
  <body>
    <header class="header">
      <a href=<?php echo MAIN."index" ; ?> ><h1>Leggera</h1> <br /></a>
    </header>
    <div class="main">