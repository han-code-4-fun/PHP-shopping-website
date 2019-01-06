<?php require_once('../private/initialize.php'); ?>

<?php
	//this webpage is the response of user search in the music_searching page
	extract($_REQUEST);
	
	//if user choose to go to cart, then jump to addOrderMusic.php
	if($_POST['orderType']=="cart"){ header('location:addOrderMusic.php');}
?>

<html>
	<head>
		<link type="text/css" href="css/layout.css"  rel="stylesheet">
		<title>Search Results</title>
	</head>
	<body>
		<h2 id="Arial">Music Buy</h2><h2>Title Search Results</h2>
		<form method="post" action="addOrderMusic.php" >
			<table border="1" align="center" id="table_text_center" >
				<tr>
					<td>Title</td>
					<td>Type</td>
					<td>id</td>
					<td>Download</td>
					<td>Price</td>
					<td>Add to Cart</td>
				</tr>
				<?php 
					Music::display_music_query_result($searchBox,$searchBy, $musicType??null,$orderType); 
				?>

			</table>
			<br />
			<input type="submit" value="Submit" name="submit"/>
			<input type="reset" value="Clear"/>
			</form>
	</body>
</html>


<?php include(SHARED_PATH . '/shared_footer.php'); ?>