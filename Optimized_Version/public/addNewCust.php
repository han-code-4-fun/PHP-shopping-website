<?php require_once('../private/initialize.php'); ?>

<?php 
//For user to register a new account and 
//to check users' input with required condition

function errorMSG($input)
{
	echo $input;
}
$errorArray = ["","","","",""];



if(isset($_POST['submit']))
{
	extract($_REQUEST);
	$fnameTrim = trim($fname);
	$lnameTrim = trim($lname);
	$emailTrim = trim($email);

	user_register_check($fnameTrim,$lnameTrim, $emailTrim, $passwd, $errorArray);
	
	
	// if($fnameTrim == "")
	// 	{
	// 		$errorArray[0] = "<td><p style='color:red'>***Your Firstname ?***</p></td>";
	// 	}else if(strlen($fnameTrim) > 20 )
	// 		{
	// 			$errorArray[0] = "<td><p style='color:red'>***Your Firstname has TOO many characters?***</p></td>";
	// 		} else
	// 			{
	// 				$errorArray[0] = "";
	// 			}
	
	// if($lnameTrim == "")
	// 	{
	// 		$errorArray[1] = "<td><p style='color:red'>***Your Lastname ?***</p></td>";
	// 	}else if(strlen($lnameTrim) > 20 )
	// 		{
	// 			$errorArray[1] = "<td><p style='color:red'>***Your Lastname has TOO many characters?***</p></td>";
	// 		}else
	// 			{
	// 				$errorArray[1]= "";
	// 			}
	// if($emailTrim == "")
	// 	{
	// 		$errorArray[2] = "<td><p style='color:red'>***Your email ?***</p></td>";
	// 	}else if(strlen($emailTrim) > 20 )
	// 		{
	// 			$errorArray[2] = "<td><p style='color:red'>***Your email has TOO many characters?***</p></td>";
	// 		}else
	// 			{
	// 				$errorArray[2] = "";
	// 			}
	// if($passwd == "")
	// 	{
	// 		$errorArray[3]= "<td><p style='color:red'>***Your Password ?***</p></td>";
	// 	}else if(strlen($passwd) != 7)	
	// 		{
	// 			$errorArray[3] = "<td><p style='color:red'>***Your Password MUST be 7 characters***</p></td>";
	// 		}else if(ctype_upper($passwd[0]))
	// 			{
	// 				$errorArray[3] = "<td><p style='color:red'>***Invalid character***</p></td>";
	// 			}else if(is_numeric($passwd))
	// 				{
	// 					$errorArray[3] = "<td><p style='color:red'>***Your Password cannot be numeric***</p></td>";
	// 				}else
	// 					{
	// 						$errorArray[3]= "";
	// 					}
				
	if($errorArray[0] == "" &&
		$errorArray[1] == "" &&
		$errorArray[2] == "" &&
		$errorArray[3] == ""
		)
		{
			//getting an Customer object
			$account = Customer::find_account($lnameTrim);

			if($account == null /* || $account->verify_passwd($passwd) == false */)
			{
				$result = Customer::register_new_account($fnameTrim,$lnameTrim,$emailTrim,$passwd);
				
				if($result)
				{
					$account = Customer::find_account($lnameTrim);
					
					$expire= time() + 60*30;
					setcookie('customerID',$account->cust_id, $expire );
					setcookie('customerName',$account->cust_fname.' '.$account->cust_lname, $expire );

					header('location:titleSrch.php');
				}
			}else{
				
				$errorArray[1] = "<td><p style='color:red'>***last name/account exists, 
									please enter another lastname/account***</p></td>";
			}
			
			
	
		}
			
	
}



?>
<html>
	<head>
		<title>New Member Register</title>
		<style>
			body{
				text-align: center;				
			}
			#first{
				font-family: arial;
			}
			table{
				width: 90%;
			
			}
			#left{
				
				text-align: right;
			}
		</style>
	</head>
	<body>
		
		<h2 id = "first">Music Buy</h2>
		<h2>New Member</h2>
		<form  method="post" action="<?php print $_SERVER['PHP_SELF']?>">
		<table border="1">
			<tr>
				<td id = "left">Enter your <b>First name</b> (MAX 20 chars.)</td>
				<td><input type="text" name="fname" value="<?php  
				if(isset($_POST['submit']))
				{
					echo $fnameTrim;
				}else
				{
					echo "";
				}
				?>" tabindex="1"></td>
				<?php errorMSG($errorArray[0]);   ?>
			</tr>
			<tr>
				<td id = "left">Enter your <b>Last name</b> (MAX 20 chars.)</td>
				<td><input type="text" name="lname" value="<?php  
				if(isset($_POST['submit']))
				{
					echo trim($_POST['lname']);
				}else
				{
					echo "";
				}
				?>" tabindex="2"></td>
				<?php errorMSG($errorArray[1]);  ?>
			</tr>
			<tr>
				<td id = "left">Your <b>e-mail</b> address (MAX 20 chars.)</td>
				<td><input type="text" name="email" value="<?php  
				if(isset($_POST['submit']))
				{
					echo trim($_POST['email']);
				}else
				{
					echo "";
				}
				?>"  tabindex="3"></td>
				<?php errorMSG($errorArray[2]);   ?>
			</tr>
			<tr>
				<td id = "left">
				Your <b>password</b><br /><br>
				
					<li>MUST BE 7 CHARACTERS</li>
					<li><b>CANNOT</b> BE ALL DIGITS</li>
					<li><b>MUST BEGIN</b> with a lowercase LETTER of<br />the alphabet</li>
					<li><b>ONLY lowercase LETTERS OF THE<br /> ALPHABET ALLOWED</b></li><br />
				
				
				</td>
				<td><input type="text" name="passwd" value="<?php  
				if(isset($_POST['submit']))
				{
					echo trim($_POST['passwd']);
				}else
				{
					echo "";
				}
				?>"  tabindex="4" size="8"></td>
				<?php errorMSG($errorArray[3]); 
					  errorMSG($errorArray[4]);  ?>
			</tr>
			<tr>
				<td id = "left"></td>
				<td><input type="submit" value="Submit" name="submit" /></td>
			</tr>
		
		
		
		</table>
		</form>
	</body>
	
	
</html>


<?php include(SHARED_PATH . '/shared_footer.php'); ?>