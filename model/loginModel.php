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

        return "Wrong";
      }

      return $dataFromDB["FirstName"]." ".$dataFromDB["SecondName"] ;
    }
    
    
  }