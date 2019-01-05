
<?php


function createMSG($input)
{
    return "<td><p style='color:red'>***".$input."***</p></td>";
}

$no_firstName = createMSG("Your Firstname ?");

$name_too_long =createMSG("Your Firstname has TOO many characters?");

$no_lastName =createMSG("Your Lastname ?");

$lName_too_long =createMSG("Your Lastname has TOO many characters?");

$no_email = createMSG("Your email ?");

$email_too_long = createMSG("Your email has TOO many characters?");

$no_passwd = createMSG("Your Password ?");

$wrong_length=createMSG("Your Password MUST be 7 characters long");

$not_start_lowercase = createMSG("Password should START with an lower case letter");

$all_numeric = createMSG("Your Password cannot be all numeric");

$pwd_uppercase =createMSG("Password show not contain upper case letter");

?>