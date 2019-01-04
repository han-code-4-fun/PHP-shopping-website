<?php

class DatabaseObject {


    static protected $database;


    static public function set_database($database) {
    self::$database = $database;
    }

    
    //assign a record into an object
    static protected function instantiate($record) {
        //whichever the class call this function will trigger its constructor
        $object = new static;
     
        foreach($record as $property => $value) {
          if(property_exists($object, $property)) {
            $object->$property = $value;
          }
        }
        return $object;
      }
}


?>