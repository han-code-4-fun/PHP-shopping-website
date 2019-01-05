<?php

class Customer extends DatabaseObject
{

    
    static protected $table_name = "customertbl";

    public $cust_id;
    public $cust_fname;
    public $cust_lname;
    public $cust_email;
    protected $cust_passw;


    static public function set_hashed_passwd($inputPwd)
    {
        $output = password_hash($inputPwd, PASSWORD_BCRYPT);
        return $output;
    }
    

    public function verify_passwd($inputPwd)
    {
        return password_verify($inputPwd, $this->cust_passw);
    }

  
    static public function find_account($lnameTrim) 
    {   //assume that there is only one unique user last name 
        //(which suppose to be account name)
        $sql = "select * from customertbl";
        $sql .= " where cust_lname='".$lnameTrim."'";

        $result = self::$database->query($sql);

        if($result->num_rows == 0) { 
            return null;
        }else if($result->num_rows == 1){
           
            $record = $result->fetch_assoc();

            $object = static::convert_record_to_object($record);
            
            //free the memory associated with $result
            $result->free();
    
            //return an array of objects
            return $object;
        }else{
            exit("Error querying database, check find_account()");
        }
    }


    static public function register_new_account(
        $fnameTrim,$lnameTrim,$cust_emailTrim,$passwd)
    {
        $passwdHash = self::set_hashed_passwd($passwd);
						
        $sql = "insert into ".self::$table_name." (";
        $sql .="cust_fname,cust_lname,cust_email,cust_passw)";
        $sql .="values('".$fnameTrim."','".$lnameTrim;
        $sql .="','".$cust_emailTrim."','".$passwdHash."')";
        $result = self::$database->query($sql);
        if($result){
            return $result;
        }else{
            exit("data insertion error, check Customer::register_new_account()");
        } 
    }




    public function __construct($args=[])
    {
        $this->cust_id = $args['cust_id'] ?? '';
        $this->cust_fname = $args['cust_fname'] ?? '';
        $this->cust_lname = $args['cust_lname'] ?? '';
        $this->cust_email = $args['cust_email'] ?? '';
        $this->cust_passw = $args['cust_passw'] ?? '';
    }
  

}


?>