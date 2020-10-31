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
    
    private function runQuery($sql, $dataToSubmit) {
      
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

        $errorFile = fopen($this->ERR_LOG, "a") ;

        fwrite($errorFile, $errorDetails) ;

        fclose($errorFile) ;
        
        return false ;
      }
    
    }
    
    /**
    * @param string $tableName : name of table to insert data
    * @param associative array $data : array of data to insert. make sure array keys of every value is same as database column name.
    */
    public function insert($tableName, $data) {
      
      //creating modified array with keys having ":new" in front to keep them as placeholders, from $data. (the ":new" can be replaced with ":" as it makes no significant difference here)
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
    
    /**
    * @param string $tableName : name of table to insert data
    * @param array $columnNames : array of column/field names. Make sure array keys of every value is same as database column name.
    * @param associative array $whereData : array of data for WHERE part of the query. Make sure array keys of every value is same as database column name.
    * @param string $whereQuery : the where part of the query. Just use the field names, as in the databse.
    */
    public function select($tableName, $columnNames, $whereData, $whereQuery) {
      
      $dataToSubmit = $this->whereDataConvert($whereData) ;
      
      $whereQuery = $this->whereQueryConvert($dataToSubmit, $whereQuery) ;
      
      $columnNames = implode(", ", $columnNames) ;
      
      $sql = "SELECT $columnNames FROM $tableName WHERE $whereQuery ;" ;
      
      if ($this->runQuery($sql,$dataToSubmit)) {
        
        return $this->runQuery($sql,$dataToSubmit) ;
        
      }
      else {
        
        return false ;
        
      }
      
    }
    
    /**
    * @param string $tableName : name of table to insert data
    * @param associative array $data : array of updated data. make sure array keys of every value is same as database column name.
    * @param associative array $whereData : array of data for WHERE part of the query. Make sure array keys of every value is same as database column name.
    * @param string $whereQuery : the where part of the query. Just use the field names, as in the databse.
    */
    public function update($tableName, $data, $whereData, $whereQuery) {
      
      //creating modified array with keys having ":new" in front to keep them as placeholders, from $data. It is neccessary to put ":new" in front of the updated data to avoid clash with whereData.
      foreach ($data as $key => $value) {
        
        $updatedData[":new$key"] = $value ;
        
      }
      
      foreach ($updatedData as $key => $value) {
      
      //placeholders for the SET part of UPDATE sql query
      $queryString .= preg_replace("/^:new/","",$key)." = ".$key.", " ;
        
      }
      
      $queryString = rtrim($queryString, ", ") ;
      
      $whereData = $this->whereDataConvert($whereData) ;

      $whereQuery = $this->whereQueryConvert($whereData, $whereQuery) ;
      
      $dataToSubmit = array_merge($updatedData, $whereData) ;
      
      $sql = "UPDATE $tableName SET $queryString WHERE $whereQuery ;" ;
      
      if ($this->runQuery($sql, $dataToSubmit)) {
        
        return true ;
        
      }
      else {
        
        return false ;
        
      }
      
    }
    
    
    /**
    * @param string $tableName : name of table to insert data
    * @param associative array $whereData : array of data for WHERE part of the query. Make sure array keys of every value is same as database column name.
    * @param string $whereQuery : the where part of the query. Just use the field names, as in the databse.
    */
    public function clear($tableName, $whereData, $whereQuery) {
      
      $dataToSubmit = $this->whereDataConvert($whereData) ;

      $whereQuery = $this->whereQueryConvert($dataToSubmit, $whereQuery) ;
      
      $sql = "DELETE FROM $tableName WHERE $whereQuery ;" ;
      
      if ($this->runQuery($sql, $dataToSubmit)) {
        
        return "true" ;
        
      }
      else {
        
        return "false" ;
        
      }
      
    }
    
    private function whereDataConvert($data) {
    
      foreach ($data as $key => $value) {

        $convertedData[":$key"] = $value ;
      }
      return $convertedData ;
    }
  
    private function whereQueryConvert($data, $whereQueryString) {
    
      foreach ($data as $key => $value) {
      
        $ColumnName = ltrim($key, ":") ;

        $conditionStatement = "$ColumnName = $key" ;
        
        $whereQueryString = preg_replace("/$ColumnName/", $conditionStatement, $whereQueryString) ;
      }
      
      return $whereQueryString ;
    }
  }