<?php

  class LoginModel extends Model {
    
    public function verifyLogin($data) {
      
      $fields = ["PassWord", "FirstName", "SecondName"] ;
      $wdata = [ "UserName" => $data["UserName"]] ;
      
      $dataFromDB = $this->database->select("User", $fields, $wdata, "UserName")->fetchAll(PDO::FETCH_ASSOC)[0] ;
      
      if (!$dataFromDB) {
        
        return "Not Found";
      }
      
      $realPassword = $dataFromDB["PassWord"] ;
      
      if (!password_verify($data["PassWord"], $realPassword)) {
        #echo "Wrong Password" ;
        return "Wrong";
      }
      #echo "You are logged in " ;
      return $dataFromDB["FirstName"]." ".$dataFromDB["SecondName"] ;
    }
    
    public function getData($username) {
      $sql = "SELECT password , firstname , secondname FROM users WHERE username = ? ;" ;
      $stmt = $this->database->prepare($sql) ;
      $stmt->execute([$username]) ;
      return $stmt->fetchAll(PDO::FETCH_ASSOC) ;
    }
    
    
  }