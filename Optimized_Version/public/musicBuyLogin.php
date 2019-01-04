<?php require_once('../private/initialize.php'); ?>

<?php
//This is the logging page


	$errorMSG = array();
	$errorMSG[0] = "";
	$errorMSG[1] = "";
	$errorMSG[2] = "";
	$errorMSG[3] = "";
	$errorMSG[4] = "";

	if(isset($_POST['login']))
	{
		extract($_REQUEST);
		$lnameTrim = trim($lname);
		$passwdTrim = trim($passwd);
		
		if(empty($lnameTrim))//check for input account name
		{
			$errorMSG[2] = "<p style='color:red'>***Your lastname?***</p>";
		}else if(strlen($lnameTrim)>20)//check for max characters
			{
				$errorMSG[0]= "<p style='color:red'>***Your lastname has TOO many characters?***</p>";
				
			} else
			{
				$errorMSG[0] = "";
				$errorMSG[2] = "";
			}
		if(empty($passwdTrim))
		{
			$errorMSG[3] = "<p style='color:red'>***Your password?***</p>";
		}else if(strlen($passwdTrim)!= 7)//pwd must be 7 characters, according to requirements
			{
				$errorMSG[1] = "<p style='color:red'>***Your password MUST HAVE 7 characters***</p>";
			} else
			{
				$errorMSG[1] = "";
				$errorMSG[3] = "";
			}
			
		if($errorMSG[0] == "" && 
			$errorMSG[1] == "" && 
			$errorMSG[2] == "" && 
			$errorMSG[3] == "" )
		{
			$myCon = mysqli_connect("localhost","root","","musicbuydb");
			
			if(mysqli_connect_errno())
			{
				printf("connection failed: %s\n",mysqli_connect_error());
    			exit();
			}else
			{
				$sql = "select * from customertbl 
				where cust_lname='".$lnameTrim."' 
				and cust_passw='".$passwdTrim."'";
				
				$result = mysqli_query($myCon, $sql);
				
				if($result !== false)
				{
					if(mysqli_num_rows($result) == 0)
					{
						$errorMSG[4]= "<p style='color:red; text-align:center'>
						***Your password DO NOT MATCH, Please Re-enter***</p>";
						
						
					}else{
						//if $record= mysqli_num_rows($result), string compare $record["cust_passwd"] to $passwdTrim
						$record= mysqli_fetch_assoc($result);
						if(strcmp($record['cust_passw'],$passwdTrim) == 0){
							//account and paswd successful, create cookie and/or session
							$expire= time() + 60*30;
							setcookie('customerID',$record['cust_id'],$expire );
							setcookie('customerName',$record['cust_fname'].' '.$record['cust_lname'],$expire );
							header('location:titleSrch.php');
						}else{
							
							$errorMSG[4]="<p style='color:red; text-align:center'>
						***Your password DO NOT MATCH, Please Re-enter***</p>";
						}
					}
					
					
				}else
				print "problem ".mysqli_error($myCon);
				
			}
			
			 mysqli_close($myCon); 
		}
		
		

	}
?>

<html>

<head>
		<meta charset="utf-8">
		<meta name="author" content="Han Zhou" />
		<meta name="description" content="buy music" />
		<meta name="keywords" content="buy music " />
		<title>Music Buy</title>
	</head>
<style>
	body{
		text-align:center;
		
	}
	table{
		position: relative;
		

	}
	#orig{
		color:blue;
		text-align: center;
		
	}
	#des{
		
		text-align: right
	}
	
</style>
<script>
	function clear(){
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
					if(isset($_POST['login']))//this is to create a sticky form
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
					if(isset($_POST['login']))
					{
						print trim($_POST['passwd']);
					}else
					print "";
				
			?>" >
				</td>
				<td><?php 	echo $errorMSG[1]; echo $errorMSG[3]; ?></td>	
			</tr>
			
			
		</table>
			<input type="submit" name="login"  value="Login" />
			<button onclick="clear()">Clear</button>
		</form>
		</h4>
		<br />
		<?php echo $errorMSG[4] ?>
		
		
		<p id="orig">For New Members, Please login here
		<button onclick="location.href='addNewCust.php'">New Member</button></p>
		
		
		
		
		
	</body>
</html>


<?php include(SHARED_PATH . '/shared_footer.php'); ?>