<?php
  
  class Controller {
    
    public function __construct() {
      #echo "base controller </br>" ;
      $this->view = new View ;
    }
      
      public function indexView($controllerName) {
        $this->view->render($controllerName) ;
      }
      
      public function loadModel($controllerName) {
        require "model/".$controllerName."Model.php" ;
        $modelName = $controllerName."Model" ;
        $this->model = new $modelName ;
      }
      
      public function errorLog($message, $location) {
        
        session_start() ;
        $_SESSION["errorlog"] = $message ;
        header("Location: $location") ;
      }
  }