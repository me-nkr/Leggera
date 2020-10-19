<?php
  
  class Contact extends Controller {
    
    
    public function test() {
      $form = new Form() ;
      
      $form ->post("name")
            ->validate("isEmpty")
            ->post("msg")
            ->validate("minLen", 5) ;
      #print_r($form->fetch()) ;
      #echo $form->fetch("name") ;
      #print_r($form->_error) ;
      #print_r($form) ;
      
      $result = $form->submit() ;
      if ($result) {
        return $this->errorLog($result, MAIN."contact") ;
      }
      else {
        header("Location: ".MAIN."contact") ;
      }
      
    }
    
  }