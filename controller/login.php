<?php
  
  class Login extends Controller {
    
    public function __construct() {
      parent::__construct() ;
      #echo "Index Page" ;
    }
    
    public function login() {
      if (!isset($_POST["submitLogin"])){
        return header("Location: ".MAIN."login") ;
      }
      $username = $_POST["username"] ;
      $password = $_POST["password"] ;
      
      $this->loadModel("login") ;
      
      $result = $this->model->verifyLogin($username,$password) ;
      
      
      switch ($result) {
        case "Not Found":
          session_start() ;
          $_SESSION["errorlog"] = "User Not Found" ;
          header("Location: login") ;
          break;
          
        case "Wrong":
          session_start() ;
          $_SESSION["errorlog"] = "Wrong Password" ;
          header("Location: login") ;
          break;
        
        default:
          session_start() ;
          $_SESSION["user"] = $username ;
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
    
    public function test() {
      
      $this->loadModel("login") ;
      
      print_r($this->model->sel("User", ["ID", "UserName"],["FirstName" => "Naveen", "SecondName" => "K R"],"FirstName AND SecondName")) ;
    }
  }