<?php

class Customer extends DatabaseObject
{

    echo "Customer class loaded";
    
    static protected $database;
    static public $table_name = "customertbl";

    public $cust_id;
    public $cust_fname;
    public $cust_lname;
    public $cust_email;
    protected $cust_passw;

    protected $inputPwd;

    

    public function verify_passwd($inputPwd)
    {
        return password_verify($inputPwd, $this->cust_passw);
    }
  
    static public function find_account($lnameTrim, $passwd) 
    {
        $sql = "select * from customertbl 
        where cust_lname='".$lnameTrim."' 
        and cust_passw='".$passwd."'";

        $result = self::$database->query($sql);

        if(!$result) {
          return null;
        }

        //should only have one unique account+ password combination
        if($result->num_rows != 1)
        {
            exit("Database error, duplicate accounts.");
        }else{
            $object=null;

            $record = $result->fetch_assoc()) 

            $object = static::instantiate($record);
            
            $result->free();
    
            //return an array of objects
            return $object;
        }
      }


    static public function register_new_account(
        $fnameTrim,$lnameTrim,$cust_emailTrim,$passwd)
    {
        $passwdHash = set_hashed_passwd($passwd);
						
        $sql = "insert into customertbl(";
        $sql .="cust_fname,cust_lname,cust_cust_email,cust_passw)";
        $sql .="values('".$fnameTrim."','".$lnameTrim;
        $sql .="','".$cust_emailTrim."','".$passwdHash."')";
        $result = self::$database->query($sql);
        
        return $result;
        
        
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