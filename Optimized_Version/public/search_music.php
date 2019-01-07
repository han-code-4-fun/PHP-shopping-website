<?php 
	require_once('../private/initialize.php');
	check_Cookie_after_login();
?>

<html>
	<head>
	<!-- name in original version: titleSrch.php -->
	<!--Searching the music in the dababases-->
		<link rel="stylesheet" type="text/css" href="css/layout.css">
		<title>Music title search</title>
	</head>
	<body>
		<h2 style="font-family: arial">Music Buy</h2>
		<!-- show customized welcome message -->
		<h2><?php print "Welcome ".$_COOKIE['customerName']; ?></h2>
		<h2>Title Search</h2>
		
		<form method="post" action="fetchDisplayMusic.php" >
			<table border="1" align="center">
				<tr>
					<td id="right">Title</td>
					<td colspan="3" id="table_text_center"><input type="text" name="searchBox" /></td>
					<td id="need_padding">
					<input type="submit" name="submit" value="Search"/></td>
				</tr>
				
				<tr>
					<td rowspan="3"></td>
					<td id="right">Search by:</td>
					<td>
						<input type="radio" name="searchBy" value="inTitle" checked>
						<b>Within Title</b></input>
					</td>
					<td rowspan="3">
						<input type="checkbox" name="musicType[]" value="p" >Pop</input><br />
						<input type="checkbox" name="musicType[]" value="c" >Country</input><br />
						<input type="checkbox" name="musicType[]" value="j" >Jazz</input>
						<p><b>All Types(If NO check box is selected)</b></p>
					</td>
					<td rowspan="3"></td>
				</tr>
				<tr>
					<td rowspan="2">
					<select name="orderType">
						<option value="music_title" selected >Order by Title (a-z)</option>
						<option value="music_type" >Order by Music Type</option>
						<option value="music_no_times" >Order by Popularity</option>
						<option value="cart">Go to Cart</option>
					</select></td>
					<td>
						<input type="radio" name="searchBy" value="stWith"> <b>Starting With</b></input>
					</td>
				</tr>
				<tr>
					<td>
						<input type="radio" name="searchBy" value="exact"> <b>Exact Title</b></input>
					</td>
				</tr>
				
			</table>
			<br />
			<input type="reset" value="Clear"/>
		</form>
	</body>
</html>


<?php include(SHARED_PATH . '/shared_footer.php'); ?>