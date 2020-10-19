<?php
  
  class Signup extends Controller {
    
    
    public function adduser() {
      
      if (!isset($_POST["submitSignup"])){
        
        return header("Location: ".MAIN."signup") ;
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
        
      }
      
      if ($this->model->setData($data)) {
        
        return header("Location: ".MAIN."login") ;
        
      }
      else {
        
        return $this->errorLog("Server Error Please Try Again After Some Time", "signup") ;
        
      }
    }
  }