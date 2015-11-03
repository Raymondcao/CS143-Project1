<html>
<head>
<link rel="stylesheet" type="text/css" href="mainframe.css"></head>
<body>
<form action="" method="post">
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("CS143", $db_connection);
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
	echo "<br><br>";
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
<br><br>
Role: <input type = "text" name="role"></input>
<br><br>
<input type="submit">
<hr>
<?php
	if($_POST['movie'] && $_POST['actor'] && $_POST['role'])
	{
	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("CS143", $db_connection);
	if(isset($_POST['movie']) && isset($_POST['actor']) && isset($_POST['role']))
	$query = sprintf("INSERT INTO MovieActor VALUES('%s', '%s', '%s')", 
						mysql_real_escape_string($_POST['movie'], $db_connection),
							mysql_real_escape_string($_POST['actor'], $db_connection),  
							mysql_real_escape_string($_POST['role'], $db_connection));
	$rs = mysql_query($query, $db_connection);
	$numrows = mysql_affected_rows();
	if($numrows > 0)
	{
		echo "<h3>Success</h3>";
	}

		mysql_close($db_connection);
	}
?>

</form>
</body>
</html>