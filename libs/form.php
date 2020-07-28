<?php
  
  require_once("utils/validator.php") ;
  
  class Form {
    
    public $_postData = [] ;
    public $_currentField = null ;
    public $_validator = null ;
    public $_error = [] ;
    
    public function __construct() {
      
    $this->_validator = new Validator() ;
    
    }
    
    public function post($fieldName) {
      
      $this->_postData[$fieldName] = $_POST[$fieldName] ;
      
      $this->_currentField = $fieldName ;
      
      return $this ;
      
    }
    
    public function fetch($fieldName = false) {
      
      if ($fieldName) {
        
        if (isset($this->_postData[$fieldName])) {
          
          return $this->_postData[$fieldName] ;
          
        }
        else return false ;
        
      }
      else {
        
        return $this->_postData ;
        
      }
    }
    
    public function validate($typeOfValidation, $arg = null) {
      
      if ($arg === null) {
        
      $result = $this->_validator->{$typeOfValidation}($this->_postData[$this->_currentField], $this->_currentField) ;
      
      }
      else {
        
      $result = $this->_validator->{$typeOfValidation}($this->_postData[$this->_currentField], $this->_currentField, $arg) ;
      
      }
      
      if ($result) {
        
        $this->_error[$this-> _currentField] = $result ;
        
      }
      
      return $this ;
      
    }
    
    public function submit() {
      
      if (empty($this->_error)) {
        
        return false ;
        
      }
      else {
        
        foreach ($this->_error as $key => $value) {
          
          $errorString .= $value."</br>" ;
          
        }

        $errorString = rtrim($errorString, "</br>") ;
        return $errorString ;
        
      }
      
    }
    
  }