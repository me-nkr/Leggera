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
      
      $form = new Form() ;

      $form ->post("FirstName")
            ->validate("isEmpty")
            ->post("SecondName")
            ->validate("isEmpty")
            ->post("UserName")
            ->validate("isEmpty")
            ->post("Email")
            ->validate("isEmpty")
            ->validate("validEmail")
            ->post("PassWord")
            ->validate("isEmpty")
            ->encrypt(PASSWORD_DEFAULT) ;

      $errors = $form->submit() ;

      if ($errors) {

        return $this->errorLog($errors, MAIN."signup") ;
        exit;
      }
      else {

        $this->loadModel("signup") ;
      
        if($this->model->userExists($form->fetch("UserName"))) {
          
          return $this->errorLog("Username Taken", MAIN."signup") ;
          exit;
          
        }
        
        if ($this->model->setData($form->fetch())) {
          
          return header("Location: ".MAIN."signup") ;
          exit;
          
        }
        else {
          
          return $this->errorLog("Server Error Please Try Again After Some Time", "signup") ;
          exit;
          
        }
      }
      
      
    }
  }