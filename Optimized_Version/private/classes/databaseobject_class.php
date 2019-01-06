<?php

class DatabaseObject {


    static protected $database;
    static protected $table_name = "";


    static public function set_database($database) {
      self::$database = $database;
    }


    //assign a record into an object
    static protected function convert_record_to_object($record) {
        //whichever the class call this function will trigger its constructor
        $object = new static;
     
        foreach($record as $property => $value) {
          if(property_exists($object, $property)) {
            $object->$property = $value;
          }
        }
        return $object;
      }

      //returning array of class object
      static public function find_by_sql($sql) {
        echo "$sql";
        $result = self::$database->query($sql);
        if(!$result) {
          exit("Database query failed.");
        }
        // results into objects
        $object_array = [];
        while($record = $result->fetch_assoc()) {
          $object_array[] = static::convert_record_to_object($record);
        }
    
        $result->free();
    
        return $object_array;
      }

      static public function find_all() {
        $sql = "select * from ".static::$tableName;
        return static::find_by_sql($sql);
      }
}


?>