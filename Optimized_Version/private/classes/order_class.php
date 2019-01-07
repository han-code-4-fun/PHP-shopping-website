<?php
class Order extends DatabaseObject
{
    static protected $table_name = "ordertbl";

    public $ord_id;
    public $ord_cust_id;
    public $ord_music_id;
    public $ord_date_added;
    public $ord_price;

    static public function find_by_id()
    {
        $sql = "select * from ".self::$table_name." ";
        $sql .= "where ord_cust_id=".(int)$_COOKIE['customerID'];
        return static::find_by_sql($sql);
    }

}


?>