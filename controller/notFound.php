<?php
  
  class NotFound extends Controller {
    
    public function __construct() {
      parent::__construct() ;
      $this->indexView("notFound") ;
      #echo "404 Page doesn't exist" ;
    }
  }