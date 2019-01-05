<?php

function user_register_check($fnameTrim,$lnameTrim, $emailTrim, $passwd, &$errorArray)
{
    
	
	if($fnameTrim == "")
    {
        $errorArray[0] = "<td><p style='color:red'>***Your Firstname ?***</p></td>";
    }else if(strlen($fnameTrim) > 20 )
        {
            $errorArray[0] = "<td><p style='color:red'>***Your Firstname has TOO many characters?***</p></td>";
        } else
            {
                $errorArray[0] = "";
            }

if($lnameTrim == "")
    {
        $errorArray[1] = "<td><p style='color:red'>***Your Lastname ?***</p></td>";
    }else if(strlen($lnameTrim) > 20 )
        {
            $errorArray[1] = "<td><p style='color:red'>***Your Lastname has TOO many characters?***</p></td>";
        }else
            {
                $errorArray[1]= "";
            }
if($emailTrim == "")
    {
        $errorArray[2] = "<td><p style='color:red'>***Your email ?***</p></td>";
    }else if(strlen($emailTrim) > 20 )
        {
            $errorArray[2] = "<td><p style='color:red'>***Your email has TOO many characters?***</p></td>";
        }else
            {
                $errorArray[2] = "";
            }
if($passwd == "")
    {
        $errorArray[3]= "<td><p style='color:red'>***Your Password ?***</p></td>";
    }else if(strlen($passwd) != 7)	
        {
            $errorArray[3] = "<td><p style='color:red'>***Your Password MUST be 7 characters***</p></td>";
        }else if(ctype_upper($passwd[0]))
            {
                $errorArray[3] = "<td><p style='color:red'>***Invalid character***</p></td>";
            }else if(is_numeric($passwd))
                {
                    $errorArray[3] = "<td><p style='color:red'>***Your Password cannot be numeric***</p></td>";
                }else
                    {
                        $errorArray[3]= "";
                    }
}


?>