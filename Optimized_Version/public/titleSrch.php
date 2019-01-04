<?php require_once('../private/initialize.php'); ?>

<html>
	
	<head>
	<!--Searching the music in the dababases-->
		<style>
			body{
				text-align: center;
			}
			table{
				width:90%;
			}
			#right{
				text-align: right;
			}
		</style>
		<title>Music title search</title>
	</head>
	<body>
		<h2 style="font-family: arial">Music Buy</h2>
		<h2><?php print "Welcome ".$_COOKIE['customerName']; ?></h2>
		<h2>Title Search</h2>
		
		<form method="post" action="fetchDisplayMusic.php" >
			<table border="1" align="center">
				<tr>
					<td id="right">Title</td>
					<td colspan="3" style="text-align: center;"><input type="text" name="searchBox" /></td>
					<td style="text-align: center; padding: 5px;">
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
						<option value="byTitle" selected >Order by Title (a-z)</option>
						<option value="byType" >Order by Music Type</option>
						<option value="byPopularity" >Order by Popularity</option>
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