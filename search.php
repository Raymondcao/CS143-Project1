<html><head>
		<title>Search Actor / Movie</title>
	</head>	
	<body>
			
			
		Search for actors/movies
		<form action="./search.php" method="GET">		
			Search: <input type="text" name="keyword">
			<input type="submit" value="Search">
		</form>
		<hr>
				
<?php
if ($_SERVER['REQUEST_METHOD'] == "GET"){
	$keyword = $_GET['keyword'];
	
	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("TEST", $db_connection);
	
	$query = sprintf("SELECT * FROM Movie WHERE title LIKE \'%'%s\'%'",$keyword);

	echo $query;
	$moives = mysql_query($query, $db_connection);

	$row = mysql_fetch_row($rs);

	while($row){
		print "<p>$row[1]</p>";

		$row = mysql_fetch_row($rs);
	}

}
?>
</body></html>