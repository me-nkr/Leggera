<?php
  
  class Login extends Controller {
    
    
    public function authenticate() {
      
      if (!isset($_POST["submitLogin"])){
        return header("Location: ".MAIN."login") ;
      }
      
      $data = ["UserName" => $_POST["username"], "PassWord" => $_POST["password"]] ;
      
      $this->loadModel("login") ;
      
      $result = $this->model->verifyLogin($data) ;
      
      
      switch ($result) {
        case "Not Found":
          return $this->errorLog("User Not Found" , "login") ;
          break;
          
        case "Wrong":
          return $this->errorLog("Wrong Password" , "login") ;
          break;
        
        default:
          session_start() ;
          $_SESSION["user"] = $data["UserName"] ;
          $_SESSION["name"] = $result ;
          header("Location: ".MAIN."index") ;
          break;
      }
    }
    
    public function logout() {
      session_start() ;
      session_unset() ;
      session_destroy() ;
      header("Location: ".MAIN."index") ;
    }
    
  }