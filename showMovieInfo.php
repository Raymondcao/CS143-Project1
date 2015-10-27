<html>
<head></head>
<body>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("TEST", $db_connection);
	$id = "";
	if(isset($_GET['id']))
			$id = $_GET['id'];	
	$query = sprintf("SELECT * FROM Movie WHERE id = '%s'", mysql_real_escape_string($id, $db_connection));
	$rs = mysql_query($query, $db_connection);
	if(mysql_num_rows($rs) > 0)
	{
		$row = mysql_fetch_assoc($rs);
		printf("<h3> %s </h3>" , $row['title'] );
		foreach($row as $name=>$value)
		{
			if($name != 'id' && $name != 'title')
			printf("%s: %s<br>", ucfirst($name), $value);
		}
	}
	$query = sprintf("SELECT genre FROM MovieGenre WHERE mid = '%s'", mysql_real_escape_string($id, $db_connection));
	$rs = mysql_query($query, $db_connection);
	$numrows = mysql_num_rows($rs);
	if($numrows > 0)
	{
		echo "Genres: ";
		for($i = 0; $i < $numrows-1; $i++)
		{
			$row = mysql_fetch_array($rs);
			printf("%s, ", $row[0]);
		}
		$row = mysql_fetch_array($rs);
		printf("%s<br>", $row[0]);
	}
	$query = sprintf("SELECT id,last,first,role FROM MovieActor mA, Actor A WHERE mid = '%s' AND A.id = mA.aid", mysql_real_escape_string($id, $db_connection));
	$rs = mysql_query($query, $db_connection);
	$numrows = mysql_num_rows($rs);
	if($numrows > 0)
	{
		echo "<p><b>Actors in this movie</b><br></p>";
		echo "<ul>";
		for($i = 0; $i < $numrows; $i++)
		{
			$row = mysql_fetch_assoc($rs);
			printf("<li> <a href=\"showActorInfo.php?id=%s\"> %s %s </a> acting as '%s' </li>", $row['id'], $row['first'], $row['last'], $row['role']);
		}
		echo "</ul>";
	}
	
	mysql_close($db_connection);
?>
</body>
</html>