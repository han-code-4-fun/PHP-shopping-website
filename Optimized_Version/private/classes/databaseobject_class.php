<?php

class DatabaseObject {

    echo "Obj class loaded";

    static protected $database;


    static public function set_database($database) {
    self::$database = $database;
    }
}


?>