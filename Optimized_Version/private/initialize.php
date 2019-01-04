<?php

  ob_start(); // turn on output buffering
  
  // session_start(); // turn on sessions if needed
  // Assign file paths to PHP constants
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PROJECT_PATH . '/shared');

  // Assign the root URL to a PHP constant
  // would dynamically find everything in URL up to "/public"
  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);

  echo "initilized!!!!!!!!!!!!" ;


?>


