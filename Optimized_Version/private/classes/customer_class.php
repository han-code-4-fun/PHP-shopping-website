<?php

class Customer extends DatabaseObject
{

    echo "Customer class loaded";
    
    static protected $database;
    static public $table_name = "customertbl";

    public $custmerId;
    public $firstName;
    public $lastName;
    public $email;
    public $hashed_password;

    static public function set_hashed_passwd($inputPwd)
    {
        $output = password_hash($inputPwd, PASSWORD_BCRYPT);
        return $output;
    }

    public function verify_passwd($inputPwd)
    {
        return password_verify($inputPwd, $this->hashed_password);
    }
  
    static public function find_by_sql($sql) 
    {
        $result = self::$database->query($sql);
        if(!$result) {
          return null;
        }
    
        // results into objects
        $object_array = [];
        while($record = $result->fetch_assoc()) {
          $object_array[] = static::instantiate($record);
        }
    
        $result->free();
    
        return $object_array;
      }

    public function if_account_exist($inputPwd)
    {
     
    }

    static public  function register_new_account(
        $fnameTrim,$lnameTrim,$emailTrim,$passwd)
    {
        $passwdHash = self::set_hashed_passwd($passwd);
						
        $sql = "insert into customertbl(";
        $sql .="cust_fname,cust_lname,cust_email,cust_passw)";
        $sql .="values('".$fnameTrim."','".$lnameTrim;
        $sql .="','".$emailTrim."','".$passwdHash."')";
        $result = self::$database->query($sql);
        
        return $result;
        
        
    }




    public function __construct($args=[])
    {
        $this->firstName = $args['firstName'] ?? '';
        $this->lastName = $args['lastName'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->hashed_password = $args['hashed_password'] ?? '';
    }
  

}


?>