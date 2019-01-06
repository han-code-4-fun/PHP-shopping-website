<?php require_once('../private/initialize.php'); ?>
<?php require_once('../private/error_check.php'); ?>



<?php
//original version file name musicBuyLogin.php


	$errorMSG = ["","","","",""];
	
	if(isset($_POST['login']))
	{
		extract($_REQUEST);
		$lnameTrim = trim($lname);
		
		user_login_check($lnameTrim, $passwd, $errorMSG);
			
		if(is_error($errorMSG) == false)
		{
		
			$account = Customer::login_check($lnameTrim, $passwd, $errorMSG[4]);

			set_Cookie_on_login($account);
		}
	}
?>

<html>

<head>
		<meta charset="utf-8">
		<meta name="author" content="Han Zhou" />
		<meta name="description" content="buy music" />
		<meta name="keywords" content="buy music " />
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<title>Music Buy</title>
	</head>

<script>
	function reset(){
		document.getElementById("lname").value = "";
		document.getElementById("password").value = "";
	}
</script>

	<body>
		<h2>Music Buy<br />Member Login</h2>
		<br /><br />
		<h4>
		<form method="post" action="<?php print ($_SERVER['PHP_SELF']); ?>">
		<table align="center">
			<tr>
				<td id="des">Enter Your Lastname(MAX: 20 characters)</td>
				<td><input type="text" name="lname" tabindex="1" id="lname"
				  value="<?php  
				  //create a sticky form
					if(isset($_POST['login']))
					{
						print trim($_POST['lname']);
					}else
					print "";
				
			?>"></td>
				<td><?php echo $errorMSG[0]; echo $errorMSG[2]; ?></td>
			</tr>
			<tr>
				<td id="des">Enter Your Password(7 characters)</td>
				<td><input type="password" name="passwd" tabindex="2" size="8" id="password"
				 value="<?php  
				 //create a sticky form
					if(isset($_POST['login']))
					{
						print $_POST['passwd'];
					}else
					print ""; ?>" >
				</td>
				<td>
				<?php 	echo $errorMSG[1]; echo $errorMSG[3]; ?></td>	
			</tr>
			
			
		</table>
			<input type="submit" name="login"  value="Login" />
			<button onclick="reset()">Reset</button>
		</form>
		</h4>
		<br />
		<?php echo $errorMSG[4] ?>
		
		
		<p id="orig">For New Members, Please login here
		<a href="<?php echo url_for('register_new_account.php') ?>"><button>New Member</button></a></p>
		
		
		
		
		
	</body>
</html>


<?php include(SHARED_PATH . '/shared_footer.php'); ?>