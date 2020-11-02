<?php
  
  class Login extends Controller {
    
    
    public function __construct() {
      
      if (!isset($_POST["submitLogin"])){
        return header("Location: ".$_SERVER['HTTP_REFERER']) ;
      }
      
      $form = new Form() ;

      $form ->post("UserName")
            ->validate("isEmpty")
            ->post("PassWord")
            ->validate("isEmpty") ;

      $errors = $form->submit() ;

      if ($errors) {

        return $this->errorLog($errors, $_SERVER['HTTP_REFERER']) ;
        exit;
      }
      else {

        $this->loadModel("login") ;
      
        $result = $this->model->verifyLogin($form->fetch()) ;
        
        
        switch ($result) {
          case "Not Found":
            return $this->errorLog("User Not Found" , $_SERVER['HTTP_REFERER']) ;
            exit;
            
          case "Wrong":
            return $this->errorLog("Wrong Password" , $_SERVER['HTTP_REFERER']) ;
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