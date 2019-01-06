<?php

  function url_for($file_path) {
    // add the leading '/' if not present
    if($file_path[0] != '/') {
      $file_path = "/" . $file_path;
    }
    return WWW_ROOT . $file_path;
  }

  function set_Cookie_on_login($object)
  {
    if($object)
    {
      $expire= time() + 60*30;
      setcookie('customerID',$object->cust_id, $expire );
      setcookie('customerName',$object->cust_fname.' '.$object->cust_lname, $expire );
      header('location:search_music.php');
    }
  }

  

?>