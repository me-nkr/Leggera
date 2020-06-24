<?php

  class LoginModel extends Model {
    
    public function verifyLogin($username,$password) {
      $data = $this->getData($username)[0] ;
      if (!$data) {
        #echo "User not Found" ;
        return "Not Found";
      }
      $realPassword = $data["password"] ;
      if (!password_verify($password, $realPassword)) {
        #echo "Wrong Password" ;
        return "Wrong";
      }
      #echo "You are logged in " ;
      return $data["firstname"]." ".$data["secondname"] ;
    }
    
    public function getData($username) {
      $sql = "SELECT password , firstname , secondname FROM users WHERE username = ? ;" ;
      $stmt = $this->database->prepare($sql) ;
      $stmt->execute([$username]) ;
      return $stmt->fetchAll(PDO::FETCH_ASSOC) ;
    }
    
    public function sel($a,$b,$c,$d) {
      
      return $this->database->select($a,$b,$c,$d) ;
    }
    
  }