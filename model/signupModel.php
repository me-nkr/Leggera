<?php

  class SignupModel extends Model {
    
    
    public function setData($data) {
      
      if ($this->database->insert("User",$data)) {
        
        return true ;
        
      }
      else {
        
        return false ;
      }
    }
    
    public function userExists($username) {
      
      $fields = ["COUNT(DISTINCT(ID))"] ;
      $wdata = ["UserName" => $username] ;
      
      $dba = $this->database->select("User", $fields, $wdata, "UserName") ;
      
      $users = $dba->fetchColumn() ;
      if (!$users) {
        return false ;
      }
      return true ;
    }
  }