<html>
<head></head>
<body>
<?php 

echo "<br>trying to establish connection<br>";
	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("TEST", $db_connection);
	$rs = mysql_query("SELECT * FROM MaxMovieID", $db_connection);
	$row = mysql_fetch_row($rs);
	$id = $row[0];
	echo "received id = $id<br>";
	$id++;
	mysql_query("UPDATE MaxMovieID SET id=id+1", $db_connection);
	
	$query = sprintf("INSERT INTO Movie VALUES('%s', '%s', '%s', '%s', '%s')",
							$id, 
							 mysql_real_escape_string($_POST['title'], $db_connection),
							mysql_real_escape_string($_POST['year'], $db_connection),  
							mysql_real_escape_string($_POST['rating'], $db_connection),
							mysql_real_escape_string($_POST['company'], $db_connection)
						);
	$rs = mysql_query($query, $db_connection);
	$affected = mysql_affected_rows($db_connection);
	if($affected > 0)
		echo "<br>Success for movies!<br>";
	$genres = array( 'Action', 'Adult', 'Adventure' ,'Animation' ,'Comedy' ,'Crime' ,'Documentary' ,'Drama', 'Family' ,'Fantasy' ,'Horror' ,'Musical' ,'Mystery' ,'Romance' , 'Sci-Fi' ,'Short', 'Thriller', 'War', 'Western');
	$len = count($genres);
	for($i = 0; $i < $len; $i++)
	{
		if(isset($_POST[$genres[$i]]))
		{
			$query = sprintf("INSERT INTO MovieGenre VALUES('%s', '%s')", $id, $genres[$i] );
			$rs = mysql_query($query, $db_connection);
				$affected = mysql_affected_rows($db_connection);
				if($affected > 0)
				echo "<br>Success for genre". $genres[$i] ."<br>";
		}
	}


?>
</body>
</html>