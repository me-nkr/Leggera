<?php
  
  class Controller {
    
      
      protected function indexView($controllerName) {

        $this->view = new View ;

        $this->view->render($controllerName) ;
      }
      
      protected function loadModel($controllerName) {
        
        require "model/".$controllerName."Model.php" ;

        $modelName = $controllerName."Model" ;

        $this->model = new $modelName ;
      }
      
      protected function errorLog($message, $location) {
        
        session_start() ;

        $_SESSION["errorlog"] = $message ;
        
        header("Location: $location") ;
      }
  }