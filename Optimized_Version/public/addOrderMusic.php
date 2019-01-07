<?php 
	require_once('../private/initialize.php'); 
	check_Cookie_after_login();
?>

<?php 
//Display the shopping cart after user add their orders
	function updateOrderTbl($checkExisting,$input)
	{

			$myCon = mysqli_connect("localhost","root","","musicbuydb");
			
			if(mysqli_connect_errno())
			{
				printf("connection failed: %s\n",mysqli_connect_error());
    			exit();
			}else
			{  
				$resultOrder = mysqli_query($myCon, $checkExisting);
				
				if($resultOrder !== false)
				{
					if(mysqli_num_rows($resultOrder) != 0)
					{
						//there is same data in the databse
						
					}else{
						
						$pos=strpos($input,',');
					
						$sql = "insert into ordertbl(ord_cust_id,ord_music_id,ord_date_added,ord_price)
								values(".(int)$_COOKIE['customerID'].",
								".(int)substr($input,0,$pos).",
								'".date('Y-m-d')."',
								".(double)substr($input,$pos+1)."
								)";
						
						$result = mysqli_query($myCon, $sql);
						
						if($result == false)
						{
							print mysqli_error($myCon);
						}
					
					}
					
				}else
				{
					print mysqli_error($myCon);
				}
			}
			
	}



	function getOrderFromDB($sql)
	{
		$myCon = mysqli_connect("localhost","root","","musicbuydb");
		
		if(mysqli_connect_errno())
		{
			printf("connection failed: %s\n",mysqli_connect_error());
			exit();
		}else
		{
			$result = mysqli_query($myCon, $sql);
			
			if($result !== false)
			{
				if(mysqli_num_rows($result) != 0)
				{
					$totalPrice = 0.0;
					for($row = 1; $row <= mysqli_num_rows($result); $row++ )
					{
						$record = mysqli_fetch_assoc($result);
						switch($record["m_icon"])
						{
							case "image/popImg.jpg":
							print '<tr><td style="color:white;background-color:red">';
							break;
							
							case "image/countryImg.jpg":
							print '<tr><td style="color:yellow;background-color:green">';
							break;
							
							case "image/jazzImg.jpg":
							print '<tr><td style="color:white;background-color:blue">';
							break;
							
						}
						
							print 	$record["music_title"].'</td>
									<td>'.$record["ord_music_id"].'</td>
									<td><img src="'.$record["m_icon"].
										'" width="80" height="75" /></td>
									<td>'.$record["orderDate"].'</td>
									<td>'.$record["m_price"].'</td>
									</tr>';
							$totalPrice += (double)$record["m_price"];
					}
							print	'<tr style=" font-weight:bold" >
										<td colspan="4" style="text-align:right">Total:</td>
										<td>$'.$totalPrice.'</td>
									</tr>';
							print '</table><table>
									<form action="processMusicOrders.php" method="post" >
										<p>Enter your Credit Card Number:
										<input type="text" name="creditNumber">
								   </p>';		
							print '<input type="submit" name="checkOut" value="CheckOut" />
									 Or </form><form method="get" action="'.$_SERVER["PHP_SELF"].'">
									 <input type="submit" name="logOut" value="Log Out" />
									 </form></table>';
									
							
					
					
				}else{
					print "</table><br /><br /><br />PLEASE CLICK BROWSER BACK BUTTON TO RETRY";
				}
				
			}else
			print mysqli_error($myCon);
			
			 mysqli_close($myCon); 
		
		}
		
	}



?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/layout.css">
		<title>Your Cart</title>
	</head>
<body>
	<h2 style="font-family: arial">Music Buy</h2>
	<h2>Order So Far for <?php  print $_COOKIE['customerName']  ?></h2>


<?php

	extract($_REQUEST);

	//if user log out
	if(isset($_GET['logOut']))
	{
		setcookie('customerID',"",time()-3600 );
		setcookie('customerName','',time()-3600);
		header('location:index.php');
	}

	//array of order objects
	$orders = Order::find_by_id();

	$musics = Music::find_all($sql);

	$musicData = MusicData::find_all();

	

	$sql="select music_title,ord_music_id,m_icon, 
					 date_format(ord_date_added,'%m-%d-%Y') as orderDate,
					 m_price 
					 from ordertbl,musictbl,music_data 
					 where ordertbl.ord_music_id = musictbl.music_id and music_data.m_type=musictbl.music_type and
					 ordertbl.ord_cust_id=".(int)$_COOKIE['customerID'];
					 

	if(isset($musicAddCart))
	{
	
		
		print '	<table border="1" align="center" id="table_text_center">
					<tr style="font-weight:bold" >
						<td>Title</td>
						<td>Id</td>
						<td>Type</td>
						<td>Date Added<br />(mm-dd-yy)</td>
						<td >Price</td>
						
					</tr>';
		
		
			foreach($musicAddCart as $eachMusicSelect)
			{
				$searchOrderTbl = "select * from ordertbl where 
									ord_cust_id=".(int)$_COOKIE['customerID']." 
									and ord_music_id="
									.(int)substr($eachMusicSelect,0,strpos($eachMusicSelect,','));
				
				updateOrderTbl($searchOrderTbl,$eachMusicSelect);
				
			}
			
			getOrderFromDB($sql);
			
			
				
	}else{
		
		print "<p>You have NOT selected anything! But below are you current selections in your CART from before</p>";
		
		print '	<table border="1" align="center" id="table_text_center">
					<tr style="font-weight:bold" >
						<td>Title</td>
						<td>Id</td>
						<td>Type</td>
						<td>Date Added<br />(mm-dd-yy)</td>
						<td>Price</td>
						
					</tr>';
			
		getOrderFromDB($sql);
	
	
		
	
}


?>
<br /><br />





</body>
</html>



<?php include(SHARED_PATH . '/shared_footer.php'); ?>