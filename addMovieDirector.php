<html>
<head></head>
<body>
<?php
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
?>
</body>
</html>