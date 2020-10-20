<?php
  
  class Bootstrap {
    
    public function __construct() {

      $url = isset($_GET["url"]) ? explode("/",rtrim($_GET["url"],"/")) : ["index"] ;

      $controllerName = $url[0] ;

      $methodName = isset($url[1]) ? $url[1] : false ;

      $controllerFile = "controller/$controllerName.php" ;

      if (file_exists($controllerFile)) {

        require "$controllerFile" ;
      }
      else {

        require "controller/notFound.php" ;

        $controller = new NotFound ;

        return ;
      }

      $controller = new $controllerName ;

      if ($methodName) {

        if (!method_exists($controller,$methodName)) {

          require "controller/notFound.php" ;

        $controller = new NotFound ;

        return ;
        }

        $controller->$methodName() ;
        
        return ;
      }
      
    }
  }