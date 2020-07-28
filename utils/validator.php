<?php

  class Validator {
    
    public function __construct() {
      
    }
    
    public function isEmpty($data, $dataField) {
      
      if ($data === "" ) {
        return "$dataField is empty" ;
      }
      else return false ;
      
    }
    
    public function minLen($data, $dataField, $arg) {
      
      if (strlen($data) < $arg ) {
        return "$dataField is less than $arg letters" ;
      }
      else return false ;
      
    }
    
  }