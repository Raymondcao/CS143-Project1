<html>
<head></head>
<body>
<form method="post">
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
	$query = "SELECT first, last ,id FROM Director ORDER BY first";
	$rs = mysql_query($query, $db_connection);
	$numrows = mysql_num_rows($rs);
	if($numrows > 0)
	{
		echo "Director: ";
		echo "<select name=\"director\">";
		for($i = 0; $i < $numrows; $i++)
		{
			$row = mysql_fetch_assoc($rs);
			printf("<option value= \"%s\">%s %s</option> ", $row['id'], $row['first'], $row['last']);
		}
		echo "</select> ";
	}

		mysql_close($db_connection);
?>
<br>
<input type="submit">

<?php
	if($_POST['director'] && $_POST['movie'])
	{
	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("TEST", $db_connection);
	if(isset($_POST['movie']) && isset($_POST['director']))
	$query = sprintf("INSERT INTO MovieDirector VALUES('%s','%s')", 
						mysql_real_escape_string($_POST['movie'], $db_connection),
							mysql_real_escape_string($_POST['director'], $db_connection));
	$rs = mysql_query($query, $db_connection);
	$numrows = mysql_affected_rows();
	if($numrows > 0)
	{
		echo "<h4>Success!!</h4>";
	}

		mysql_close($db_connection);
	}
?>
</form>
</body>
</html>