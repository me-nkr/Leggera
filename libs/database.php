<?php

  class Database extends PDO {
    
    public function __construct($DBH, $ERR_LOG) {
      try {
        parent::__construct($DBH["DSN"], $DBH["DBUSER"], $DBH["DBPASS"]) ;
        $this->ERR_LOG = $ERR_LOG ;
      } 
      catch (PDOException $e) {
        
        if ($e->getMessage() === "SQLSTATE[HY000] [2002] No such file or directory") {
          echo "Database Off" ;
        }
        else {
          echo $e->getMessage() ;
        }
          exit() ;
        
      }
    }
    
    //DB CURD functions
    
    public function runQuery($sql, $dataToSubmit) {
      
      $stmt = $this->prepare($sql) ;
      if ($stmt->execute($dataToSubmit)) {
        return $stmt ;
      }
      else {
        //errorlog in the specified file.
        $errorDate = date("l d/m/y H:i:s") ;
        $errorData = $stmt->errorInfo() ;
        $errorInfo = "SQLSTATE :($errorData[0]), Error Code :($errorData[1]), Error Message :($errorData[2])" ;
        
        $errorDetails = "[$errorDate] [$errorInfo]\n" ;
        $error = fopen($this->ERR_LOG, "a") ;
        fwrite($error, $errorDetails) ;
        fclose($error) ;
        
        return false ;
      }
    
    }
    
    /**
    * @param string $tableName : name of table to insert data
    * @param associative array $data : array of data to insert. make sure array keys of every value is same as database column name.
    */
    public function insert($tableName, $data) {
      
      //creating modified array with keys having ":new" in front to keep them as placeholders, from $data.
      foreach ($data as $key => $value) {
        
        $dataToSubmit[":new$key"] = $value ;
        
      }
      
      //creates strings to place in sql query.
      foreach ($dataToSubmit as $key => $value) {
        
        $columnNames .= preg_replace("/^:new/","",$key).", " ;
        $placeholders .= "$key, " ;
        
      }
      
      $columnNames = rtrim($columnNames, ", ") ;
      $placeholders = rtrim($placeholders, ", ") ;
      
      $sql = "INSERT INTO $tableName ($columnNames) VALUES ($placeholders) ;" ;
      
      if ($this->runQuery($sql, $dataToSubmit)) {
        
        return true ;
        
      }
      else {
        
        return false ;
        
      }
    }
    
    public function select($tableName, $columnNames, $wdata, $wquery) {
      
      $pwdata = $this->wdata($wdata) ;
      
      $wquery = $this->wqstr($pwdata, $wquery) ;
      
      $columnNames = implode(", ", $columnNames) ;
      
      $sql = "SELECT $columnNames FROM $tableName WHERE $wquery ;" ;
      
      if ($this->runQuery($sql,$pwdata)) {
        
        return $this->runQuery($sql,$pwdata) ;
        
      }
      else {
        
        return false ;
        
      }
      
    }
    
    public function wdata($data) {
    
      foreach ($data as $key => $value) {
        $pwdata[":$key"] = $value ;
      }
      return $pwdata ;
    }
  
    public function wqstr($data, $wqstr) {
    
      foreach ($data as $key => $value) {
      
        $fname = ltrim($key, ":") ;
        $cond = "$fname = $key" ;
        //echo $cond."<br/>" ;
        $wqstr = preg_replace("/$fname/", $cond, $wqstr) ;
      }
      
      return $wqstr ;
    }
  }