<?php require_once('../private/initialize.php'); ?>

<?php
//this page is the response of user search in the music_searching page

function checkMusicData($input, $myConnection)
{
if(mysqli_connect_errno())
	{
		printf("connection failed: %s\n",mysqli_connect_error());
	exit();
	}else
	{
		$resultMData = mysqli_query($myConnection, $input);
		
		if($resultMData !== false)
		{
			if(mysqli_num_rows($resultMData) != 0)
			{
				
				$musicResult=$resultMData->fetch_assoc();
				return $musicResult;
			}
			
		}else
		print "problem ".mysqli_error($myConnection);
		
	}
}
?>
<html>
	<head>
		<style>
			body{
				text-align: center;
			}
			table{
				width:90%;
				text-align: center;
			}
			#right{
				text-align: right;
			}
		</style>
		<title>Search Results</title>
	</head>
	<body>
		<h2 style="font-family: arial">Music Buy</h2><h2>Title Search Results</h2>
		<form method="post" action="addOrderMusic.php" >
			<table border="1" align="center">
				<tr>
					<td>Title</td>
					<td>Type</td>
					<td>id</td>
					<td>Download</td>
					<td >Price</td>
					<td>Add to Cart</td>
				</tr>
		<?php
			extract($_REQUEST);
			
	
			if($_POST['orderType']=="cart")
			{	
				header('location:addOrderMusic.php');
				
			}else{
					
			
				$searchBox = trim($searchBox);
				
				function getInfoFromDB($sql)
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
								for($row = 1; $row <= mysqli_num_rows($result); $row++ )
								{
									$record = mysqli_fetch_assoc($result);
									switch($record["music_type"])
									{
										case "p":
										$sqlData = "select * from music_data where m_type ='p'";
										$musicDataResult = checkMusicData($sqlData,$myCon);
										print '<tr><td style="color:white;background-color:red">';
										break;
										
										case "c":
										$sqlData = "select * from music_data where m_type ='c'";
										$musicDataResult = checkMusicData($sqlData,$myCon);
										print '<tr><td style="color:yellow;background-color:green">';
										break;
										
										case "j":
										$sqlData = "select * from music_data where m_type ='j'";
										$musicDataResult = checkMusicData($sqlData,$myCon);
										print '<tr><td style="color:white;background-color:blue">';
										
										
									}
									
									print $record["music_title"].'</td>
									<td><img src="'.$musicDataResult["m_icon"].
										'" width="80" height="75" /></td>
									<td>'.$record["music_id"].'</td>
									<td style="background-color:yellow" >'
										.$record["music_no_times"].'</td>
									<td style="background-color:#e2851d" >'
										.$musicDataResult["m_price"].'</td>
									<td><input type="checkbox" name="musicAddCart[]" value="
											'.$record["music_id"].',
											'.$musicDataResult["m_price"].'
									 		" /></td>
									</tr>';
									
								}
								
								
							}
							
						}else
						print "problem ".mysqli_error($myCon);
						
					}
					
					 mysqli_close($myCon); 
				}


				if($searchBox == "")
				{
						if($orderType == "byTitle")
						{
							if(!isset($musicType))
							{
								
									$searchString = "select * from musictbl order by music_title asc";
									getInfoFromDB($searchString);
								
							}else{
								$stringInput = "";
								
								for($idx=0;$idx<sizeof($musicType); $idx++)
								{
									$stringInput = $stringInput. 
									" select * from (select * from musictbl where music_type='"
									.$musicType[$idx]."') as ".$musicType[$idx]." union all";
								}
								$stringInput = rtrim($stringInput,"union all");
								$stringInput = $stringInput." order by music_title asc";
								getInfoFromDB($stringInput);
							}
							
						}
						if($orderType == "byType")
						{
							if(!isset($musicType))
							{
								$searchString = "select * from musictbl order 
													by music_type, music_title";
								getInfoFromDB($searchString);
								
							}else{
								$stringInput = "";
								
								for($idx=0;$idx<sizeof($musicType); $idx++)
								{
									$stringInput = $stringInput. 
									" select * from (select * from musictbl where music_type='"
									.$musicType[$idx]."') as ".$musicType[$idx]." union all";
								}
								$stringInput = rtrim($stringInput,"union all");
								$stringInput = $stringInput." order by music_type, music_title asc";
								getInfoFromDB($stringInput);
								
							}
							
						}
						if($orderType == "byPopularity")
						{
							if(!isset($musicType))
							{
								$searchString = "select * from musictbl order by 
													music_no_times desc, music_title asc";
								getInfoFromDB($searchString);
								
							}else{
								$stringInput = "";
								
								for($idx=0;$idx<sizeof($musicType); $idx++)
								{
									$stringInput = $stringInput. 
									" select * from (select * from musictbl where music_type='"
									.$musicType[$idx]."') as ".$musicType[$idx]." union all";
								}
								$stringInput = rtrim($stringInput,"union all");
								$stringInput = $stringInput." order by music_no_times desc, music_title asc";
								getInfoFromDB($stringInput);
								
							}
							
						}
					
			
					
				}else{
					
						if($orderType == "byTitle")
						{
							if(!isset($musicType))
							{
								if($searchBy == "inTitle")
								{
									$searchString = "select * from musictbl where
								 	music_title like '%".$searchBox."%' order by music_title asc";
									getInfoFromDB($searchString);
								}
								if($searchBy == "stWith")
								{
									$searchString = "select * from musictbl where
								 	music_title like '".$searchBox."%' order by music_title asc";
									getInfoFromDB($searchString);
									
								}
								if($searchBy =="exact")
								{
									$searchString = "select * from musictbl where
								 	music_title like '".$searchBox."' order by music_title asc";
									getInfoFromDB($searchString);
									
								}
								
								
							}else{
								$stringInput = "";
								
								for($idx=0;$idx<sizeof($musicType); $idx++)
								{
									if($searchBy == "inTitle")
									{
										$stringInput = $stringInput. 
										" select * from (select * from musictbl where music_type='"
										.$musicType[$idx]."' and music_title like '%".$searchBox.
										"%' ) as ".$musicType[$idx]." union all";
									}
									if($searchBy == "stWith")
									{
										$stringInput = $stringInput. 
										" select * from (select * from musictbl where music_type='"
										.$musicType[$idx]."' and music_title like '".$searchBox.
										"%' ) as ".$musicType[$idx]." union all";
									}
									if($searchBy =="exact")
									{
										$stringInput = $stringInput. 
										" select * from (select * from musictbl where music_type='"
										.$musicType[$idx]."' and music_title like '".$searchBox.
										"' ) as ".$musicType[$idx]." union all";
									}
								}
								$stringInput = rtrim($stringInput,"union all");
								$stringInput = $stringInput." order by music_title asc";
								getInfoFromDB($stringInput);
							}
							
						}
						if($orderType == "byType")
						{
							if(!isset($musicType))
							{
								if($searchBy == "inTitle")
								{
									$searchString = "select * from musictbl where
									 	music_title like '%".$searchBox."%' 
									 	order by music_type asc,music_title asc";
									getInfoFromDB($searchString);
								}
								if($searchBy == "stWith")
								{
									$searchString = "select * from musictbl where
									 	music_title like '".$searchBox."%' 
									 	order by music_type asc,music_title asc";
									getInfoFromDB($searchString);
									
								}
								if($searchBy =="exact")
								{
									$searchString = "select * from musictbl where
									 	music_title like '".$searchBox."' 
									 	order by music_type asc,music_title asc";
									getInfoFromDB($searchString);
									
								}
							}else{
								$stringInput = "";
								
								for($idx=0;$idx<sizeof($musicType); $idx++)
								{
									if($searchBy == "inTitle")
									{
										$stringInput = $stringInput. 
										" select * from (select * from musictbl where music_type='"
										.$musicType[$idx]."' and music_title like '%".$searchBox.
										"%' ) as ".$musicType[$idx]." union all";
									}
									if($searchBy == "stWith")
									{
										$stringInput = $stringInput. 
										" select * from (select * from musictbl where music_type='"
										.$musicType[$idx]."' and music_title like '".$searchBox.
										"%' ) as ".$musicType[$idx]." union all";
									}
									if($searchBy =="exact")
									{
										$stringInput = $stringInput. 
										" select * from (select * from musictbl where music_type='"
										.$musicType[$idx]."' and music_title like '".$searchBox.
										"' ) as ".$musicType[$idx]." union all";
									}
								}
								$stringInput = rtrim($stringInput,"union all");
								$stringInput = $stringInput." order by music_type asc,music_title asc";
								getInfoFromDB($stringInput);
							}
							
						}
						if($orderType == "byPopularity")
						{
							if(!isset($musicType))
							{
								if($searchBy == "inTitle")
								{
									$searchString = "select * from musictbl where
								 	music_title like '%".$searchBox."%' order by 
								 	music_no_times desc, music_title asc";
								}
								if($searchBy == "stWith")
								{
									$searchString = "select * from musictbl where
								 	music_title like '".$searchBox."%' order by 
								 	music_no_times desc, music_title asc";
									
								}
								if($searchBy =="exact")
								{
									$searchString = "select * from musictbl where
								 	music_title like '".$searchBox."' order by 
								 	music_no_times desc, music_title asc";
									
								}
								getInfoFromDB($searchString);
								
							}else{
								$stringInput = "";
								
								for($idx=0;$idx<sizeof($musicType); $idx++)
								{
									if($searchBy == "inTitle")
									{
										$stringInput = $stringInput. 
										" select * from (select * from musictbl where music_type='"
										.$musicType[$idx]."' and music_title like '%".$searchBox.
										"%' ) as ".$musicType[$idx]." union all";
									}
									if($searchBy == "stWith")
									{
										$stringInput = $stringInput. 
										" select * from (select * from musictbl where music_type='"
										.$musicType[$idx]."' and music_title like '".$searchBox.
										"%' ) as ".$musicType[$idx]." union all";
									}
									if($searchBy =="exact")
									{
										$stringInput = $stringInput. 
										" select * from (select * from musictbl where music_type='"
										.$musicType[$idx]."' and music_title like '".$searchBox.
										"' ) as ".$musicType[$idx]." union all";
									}
								}
								$stringInput = rtrim($stringInput,"union all");
								$stringInput = $stringInput." order by music_no_times desc, music_title asc";
								getInfoFromDB($stringInput);
								
							}
							
							
						}
					
				}
			}

	?>
			</table>
			<br />
			<input type="submit" value="Submit" name="submit"/>
			<input type="reset" value="Clear"/>
			</form>
	</body>
</html>


<?php include(SHARED_PATH . '/shared_footer.php'); ?>