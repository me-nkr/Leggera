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

      
      
      $result = $form->submit() ;

      if ($result) {

        return $this->errorLog($result, MAIN."contact") ;
        exit;
      }
      else {

        header("Location: ".MAIN."contact") ;
        exit;

      }
      
    }
    
  }