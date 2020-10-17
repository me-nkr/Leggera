<?php

  /**
   * edit this to configure your database.
  */
  define("DBTYPE", "mysql") ;
  define("DBSERVER", "localhost") ;
  define("DBNAME", "mvc") ;
  define("DBUSER", "developer") ;
  define("DBPASS", "#Developdb0") ;
  
  
  /**
   * for PDO 
   * do not edit unless you know what you're doing
  */
  define("DSN", DBTYPE.": host=".DBSERVER."; dbname=".DBNAME) ;
  define("DBH", [ "DSN" => DSN, "DBUSER" => DBUSER, "DBPASS" => DBPASS]) ;
  
  /**
   * for mysqli 
   * do not edit unless you know what you're doing
  */
  //Uncomment the following line to use.
  //define("DBH", DBSERVER.", ".DBUSER.", ".DBPASS.", ".DBNAME) ;
  