<?php
  
  class View {
    
    public function __construct() {
      #echo "base view </br>" ;
    }
    
    public function render($viewName) {
      $this->viewName = $viewName ;
      require "view/header.php" ;
      require "view/$viewName/index.php" ;
      require "view/footer.php" ;
    }
  }