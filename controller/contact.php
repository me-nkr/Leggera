<?php
  
  class Contact extends Controller {
      

    public function __construct() {

      $this->indexView("contact") ;
    }
    
    public function test() {

      $form = new Form() ;
      
      $form ->post("name")
            ->validate("isEmpty")
            ->post("msg")
            ->validate("minLen", 5) ;

      $errors = $form->submit() ;     

      if ($errors) {

        return $this->errorLog($errors, MAIN."contact") ;
        exit;
      }
      else {

        header("Location: ".MAIN."contact") ;
        exit;

      }
      
    }
    
  }