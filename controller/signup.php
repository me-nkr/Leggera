<?php
  
  class Signup extends Controller {
    
    public function __construct() {

      $this->indexView("signup") ;
    }

    public function signup() {
      
      if (!isset($_POST["submitSignup"])){
        
        return header("Location: ".MAIN."signup") ;
        exit;
      }
      
       $data = [
         "UserName" => $_POST["username"],
         "FirstName" => $_POST["firstname"],
         "SecondName" => $_POST["secondname"],
         "Email" => $_POST["mail"],
         "PassWord" => password_hash($_POST["password"],PASSWORD_DEFAULT)
       ] ;
      
      $this->loadModel("signup") ;
      
      if($this->model->userExists($data["UserName"])) {
        
        return $this->errorLog("Username Taken", "signup") ;
        exit;
        
      }
      
      if ($this->model->setData($data)) {
        
        return header("Location: ".MAIN."login") ;
        exit;
        
      }
      else {
        
        return $this->errorLog("Server Error Please Try Again After Some Time", "signup") ;
        exit;
        
      }
    }
  }