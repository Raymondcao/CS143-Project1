<html>
<head></head>
<body>
<form action="addMovieActor.php" method="post">
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("TEST", $db_connection);
	$query = "SELECT title,id FROM Movie ORDER BY title";
	$rs = mysql_query($query, $db_connection);
	$numrows = mysql_num_rows($rs);
	if($numrows > 0)
	{
		echo "Movie: ";
		echo "<select name=\"movie\">";
		for($i = 0; $i < $numrows; $i++)
		{
			$row = mysql_fetch_assoc($rs);
			printf("<option value= \"%s\">%s</option> ", $row['id'], $row['title']);
		}
		echo "</select>";
	}
	echo "<br>";
	$query = "SELECT first, last ,id FROM Actor ORDER BY first";
	$rs = mysql_query($query, $db_connection);
	$numrows = mysql_num_rows($rs);
	if($numrows > 0)
	{
		echo "Actor: ";
		echo "<select name=\"actor\">";
		for($i = 0; $i < $numrows; $i++)
		{
			$row = mysql_fetch_assoc($rs);
			printf("<option value= \"%s\">%s %s</option> ", $row['id'], $row['first'], $row['last']);
		}
		echo "</select> ";
	}

		mysql_close($db_connection);
?>
<br><br><br>
Role: <input type = "text" name="role"></input>
<br>
<input type="submit">
</form>
</body>
</html>