<?php
  
  class Login extends Controller {
    
    
    public function __construct() {
      
      if (!isset($_POST["submitLogin"])){
        return header("Location: ".$_SERVER['HTTP_REFERER']) ;
      }
      
      $data = ["UserName" => $_POST["username"], "PassWord" => $_POST["password"]] ;
      
      $this->loadModel("login") ;
      
      $result = $this->model->verifyLogin($data) ;
      
      
      switch ($result) {
        case "Not Found":
          return $this->errorLog("User Not Found" , $_SERVER['HTTP_REFERER']) ;
          exit;
          
        case "Wrong":
          return $this->errorLog("Wrong Password" , $_SERVER['HTTP_REFERER']) ;
          exit;
        
        default:
          session_start() ;
          $_SESSION["user"] = $data["UserName"] ;
          $_SESSION["name"] = $result ;
          header("Location: ".MAIN."index") ;
          exit;
      }
    }
    
    public function logout() {
      session_start() ;
      session_unset() ;
      session_destroy() ;
      header("Location: ".MAIN."index") ;
      exit;
    }
    
  }