<?php

  class Model {
    
    public function __construct() {
      $this->database = new Database(DBH,ERR_LOG) ;
    }
  }