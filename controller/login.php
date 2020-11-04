<?php
  
  class Login extends Controller {
    
    
    public function __construct() {
      
      if (!isset($_POST["submitLogin"])){

        return header("Location: ".MAIN."index") ;
        exit;
      }
      
      $form = new Form() ;

      $form ->post("UserName")
            ->validate("isEmpty")
            ->post("PassWord")
            ->validate("isEmpty") ;

      $errors = $form->submit() ;

      if ($errors) {

        return $this->errorLog($errors, MAIN."index") ;
        exit;
      }
      else {

        $this->loadModel("login") ;
      
        $result = $this->model->verifyLogin($form->fetch()) ;
        
        
        switch ($result) {
          case "Not Found":
            return $this->errorLog("User Not Found" , MAIN."index") ;
            exit;
            
          case "Wrong":
            return $this->errorLog("Wrong Password" , MAIN."index") ;
            exit;
          
          default:
            session_start() ;
            $_SESSION["user"] = $form->fetch(["UserName"]) ;
            $_SESSION["name"] = $result ;
            header("Location: ".MAIN."index") ;
            exit;
      }
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