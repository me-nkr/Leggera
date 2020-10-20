<?php
  
  class View {
    
    public function render($viewName) {

      $this->viewName = $viewName ;

      require "view/header.php" ;

      require "view/$viewName/index.php" ;
      
      require "view/footer.php" ;
    }
  }