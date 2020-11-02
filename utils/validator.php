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

    public function maxLen($data, $dataField, $arg) {
      
      if (strlen($data) > $arg ) {
        return "$dataField is more than $arg letters" ;
      }
      else return false ;
      
    }

    public function validEmail($data, $dataField) {
      
      if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        return "$dataField is invalid" ;
      }
      else return false ;
      
    }
    
  }