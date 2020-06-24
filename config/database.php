<?php

  /**
   * edit this to configure your database.
  */
  define("DBTYPE", "mysql") ;
  define("DBSERVER", "localhost") ;
  define("DBNAME", "signin") ;
  define("DBUSER", "root") ;
  define("DBPASS", "mydatabase") ;
  
  
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
  