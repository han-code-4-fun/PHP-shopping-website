<?php require_once('../private/initialize.php'); ?>

<html>
	<head>
		<style>
			body{
				text-align: center
			}
			
		</style>
		<title>Your Cart</title>
	</head>
<body>
	<h2 style="font-family: arial">Music Buy</h2>
	<h2>Order So Far for <?php  print $_COOKIE['customerName']  ?></h2>
	
	
</body>
</html>

<?php



extract($_REQUEST);

if(isset($_GET['logout']))
	{
		setcookie('customerID',"",time()-3600 );
		setcookie('customerName','',time()-3600);
		header('location:musicBuyLogin.php');
	}

if(isset($checkOut))
{
	$creditNumber = trim($creditNumber);
	
	if(!is_numeric($creditNumber)) //check credit card information
	{
		echo "PLEASE PRESS BROWSER BACK BUTTON AND RE-ENTER YOUR CREDIT CARD NUMBER";
	}
	else
	{
		if(strlen($creditNumber) !== 16)
		{
			echo "PLEASE PRESS BROWSER BACK BUTTON AND RE-ENTER YOUR CREDIT CARD NUMBER";
		}
		else
		{	
			 $myConnection = mysqli_connect("localhost","root","","musicbuydb");
 

		 if(mysqli_connect_errno())
		  {
		    printf("connection failed: %s\n",mysqli_connect_error());
		    exit();
		   }
		  else
		    {	$sql = "select * from ordertbl where ord_cust_id=".(int)$_COOKIE['customerID'];
		    	
		    	$result = mysqli_query($myConnection, $sql);
		    	
		    	if($result !== false)
				{
					if(mysqli_num_rows($result) == 0)
					{
						echo "Order has ALREADY been processed!!!!<br /><br />
							 Please Close Your Browser to exit<br /><br />";
					}
					else
					{
						$sql = "update musictbl,ordertbl set music_no_times =
								 music_no_times + 1 where ord_music_id=music_id and 
								 ord_cust_id=".(int)$_COOKIE['customerID'];
								
						$result = mysqli_query($myConnection, $sql);
						
						if($result == TRUE)
						{	
							$sql = "delete from ordertbl where ord_cust_id=".(int)$_COOKIE['customerID'];
							$result = mysqli_query($myConnection, $sql);
							
							if($result == TRUE) //if the credit card information is entered correctly
							{	
								echo "Thanks You, Please Close Your Browser to exit<br /><br />";
							}
							else
							{
								print "problem".mysqli_error($myConnection);
							}
						}
						else
						{
							print "problem".mysqli_error($myConnection);
						}
						
						
					    
					}
		    	
				}else{
					print "problem".mysqli_error($myConnection);
				}
			    mysqli_close($myConnection); 
		    }
						
				echo '<form method="get" action="'.$_SERVER["PHP_SELF"].'">
						Or <input type="submit" name="logout" value="Log Out" /></form>';
					
					
					
		}
			
	}
		
}
?>


<?php include(SHARED_PATH . '/shared_footer.php'); ?>