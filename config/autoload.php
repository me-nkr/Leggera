<?php 

  spl_autoload_register(function($class) {
    $class = strtolower($class) ;
    require "libs/".$class.".php" ;
  }) ;