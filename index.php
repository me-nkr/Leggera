<?php
  
  // Config files
  require "config/paths.php" ;
  require "config/database.php" ;
  
  // Autoloader for classes.
  require "config/autoload.php" ;
  
  
  //instantiate bootstrap class
  $app = new bootstrap() ;
?>
