<?php 

  spl_autoload_register(function($class) {
    require "libs/".$class.".php" ;
  }) ;