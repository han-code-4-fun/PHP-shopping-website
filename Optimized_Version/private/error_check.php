<?php  require_once('error_MSG.php'); ?>
<?php
    function user_login_check($lnameTrim, $passwdTrim,&$errorMSG)
    {
        if(empty($lnameTrim))//check for input account name
            {
                $errorMSG[2] = $GLOBALS['no_lastName'];
            }else if(strlen($lnameTrim)>20)//check for max characters
                {
                    $errorMSG[0]= $GLOBALS['lName_too_long'];
                    
                } else
                {
                    $errorMSG[0] = "";
                    $errorMSG[2] = "";
                }
            if(empty($passwdTrim))
            {
                $errorMSG[3] = $GLOBALS['no_passwd'];
            }else if(strlen($passwdTrim)!= 7)
                {//pwd must be 7 characters, according to the project requirements
                    $errorMSG[1] = $GLOBALS['wrong_length'];
                } else
                {
                    $errorMSG[1] = "";
                    $errorMSG[3] = "";
                }
    }


    function user_register_check($fnameTrim,$lnameTrim, $emailTrim, $passwd, &$errorArray)
    {
    
        
        if($fnameTrim == "")
        {
            $errorArray[0] = $GLOBALS['no_firstName'];
        }else if(strlen($fnameTrim) > 20 )
            {
                $errorArray[0] = $GLOBALS['name_too_long'];
            } else
                {
                    $errorArray[0] = "";
                }

        if($lnameTrim == "")
        {
            $errorArray[1] = $GLOBALS['no_lastName'];
        }else if(strlen($lnameTrim) > 20 )
            {
                $errorArray[1] =$GLOBALS['lName_too_long'];
            }else
                {
                    $errorArray[1]= "";
                }
        if($emailTrim == "")
        {
            $errorArray[2] = $GLOBALS['no_email'];
        }else if(strlen($emailTrim) > 20 )
            {
                $errorArray[2] = $GLOBALS['email_too_long'];
            }else
                {
                    $errorArray[2] = "";
                }
        if($passwd == "")
        {
            $errorArray[3]= $GLOBALS['no_passwd'];
        }else if(strlen($passwd) != 7)	
            {
                $errorArray[3] = $GLOBALS['wrong_length'];
            }else if(is_numeric($passwd))
                {
                    $errorArray[3] = $GLOBALS['all_numeric'];
                }else if(is_any_uppercase_letter($passwd))
                    {
                        $errorArray[3]= $GLOBALS['pwd_uppercase'];
                    }else if(!ctype_lower($passwd[0]))
                            {
                                $errorArray[3] = $GLOBALS['not_start_lowercase'];
                            }else{
                                        $errorArray[3]= "";
                                }
    }

    function is_error($errorArray)
    {
        if( $errorArray[0] == "" && $errorArray[1] == "" && $errorArray[2] == "" && $errorArray[3] == "")
        {
            return false;
        }else{
            return true;
        }
    
    }


    function is_any_uppercase_letter($input)
    {
        for ($i=0; $i < strlen($input); $i++) { 
            if(ctype_upper($input[$i]))
            {
                return true;
            }
        }
        return false;
    }

    function account_exist()
    {
        
        return $GLOBALS['account_exist'];
    }


?>