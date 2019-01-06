<?php require_once('../private/initialize.php'); ?>
<?php require_once('../private/error_check.php'); ?>

<?php 

	function errorMSG($input)
	{
		echo $input;
	}
	//store pre-allocated error msg into an array, msg position is requested by project designer
	$errorArray = ["","","","",""];


	if(isset($_POST['submit']))
	{
		extract($_REQUEST);
		$fnameTrim = trim($fname);
		$lnameTrim = trim($lname);
		$emailTrim = trim($email);

		user_register_check($fnameTrim,$lnameTrim, $emailTrim, $passwd, $errorArray);
				
		if(is_error($errorArray) == false)
		{
			//getting an Customer object
			$account = Customer::find_account($lnameTrim);

			if($account == null /* || $account->verify_passwd($passwd) == false */)
			{
				$result = Customer::register_new_account($fnameTrim,$lnameTrim,$emailTrim,$passwd);
				
				if($result)
				{
					$account = Customer::find_account($lnameTrim);
					
					set_Cookie_on_login($account);
				}
			}else{
				
				$errorArray[1] = $GLOBALS['account_exist'];
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