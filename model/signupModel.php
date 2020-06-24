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
      $sql = "SELECT COUNT(DISTINCT(ID)) FROM User WHERE UserName = ? ;" ;
      $stmt = $this->database->prepare($sql) ;
      $stmt->execute([$username]) ;
      $users = $stmt->fetchColumn() ;
      if (!$users) {
        return false ;
      }
      return true ;
    }
  }