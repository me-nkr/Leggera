<?php

  /**
   * edit this to configure your database.
  */
  define("DBTYPE", "mysql") ;
  define("DBSERVER", "__DATABASE_SERVERNAME__") ;
  define("DBNAME", "__DATABASE_NAME__") ;
  define("DBUSER", "__dATABASE_USERNAME__") ;
  define("DBPASS", "__DATABASE_PASSWORD__") ;
  
  
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
  