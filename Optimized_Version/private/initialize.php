<?php

// turn on output buffering
  ob_start(); 
  

  // Assign file paths to PHP constants
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PROJECT_PATH . '/shared');

  // Assign the root URL to a PHP constant
  // would dynamically find everything in URL up to "/public"
  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);


  //load function classes
  require_once('functions.php');
  
  require_once('database_credential.php');

  require_once('database_functions.php');

  //auto load object/database classes
  foreach(glob('classes/*_class.php') as $file) {
    require_once($file);
  }


  function my_autoload($class) {
    if(preg_match('/\A\w+\Z/', $class)) {
      include('classes/' . $class . '_class.php');
    }
  }
  spl_autoload_register('my_autoload');

  //load musicbuydb into an Database Object
  $database = db_connect();
  DatabaseObject::set_database($database);



?>


