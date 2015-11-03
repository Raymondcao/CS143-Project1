<html>
<head>
<link rel="stylesheet" type="text/css" href="mainframe.css"></head>
<body>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("CS143", $db_connection);
	$id = "";
	if(isset($_GET['id']))
			$id = $_GET['id'];	
	$query = sprintf("SELECT * FROM Actor WHERE id = '%s'", mysql_real_escape_string($id, $db_connection));
	$rs = mysql_query($query, $db_connection);
	if(mysql_num_rows($rs) > 0)
	{
		$row = mysql_fetch_assoc($rs);
		printf("<h3> %s %s</h3>" , $row['first'], $row['last'] );
		//|| $value == "0000-00-00"
		foreach($row as $name=>$value)
		{
			if($name != 'id' && $name != 'last' && $name != 'first')
				if(($value=="" ) && $name == 'dod')
					printf("%s: %s<br>", ucfirst($name), "Still Alive");
				else
					printf("%s: %s<br>", ucfirst($name), $value);
		}
	}
	$query = sprintf("SELECT id,title,role FROM Movie M, MovieActor mA WHERE M.id = mA.mid AND aid='%s'", mysql_real_escape_string($id, $db_connection));
	$rs = mysql_query($query, $db_connection);
	$numrows = mysql_num_rows($rs);
	if($numrows > 0)
	{
		echo "<br><b>Filmography: </b> <br>";
		echo "<ul>";
		for($i = 0; $i < $numrows; $i++)
		{
			$row = mysql_fetch_assoc($rs);
			printf("<li>Acted as '%s' in <a href=\"showMovieInfo.php?id=%s\"> %s </a> </li> ", $row['role'], $row['id'], $row['title']);
		}
		echo "</ul>";
	}
		mysql_close($db_connection);
?>
<hr>
Search for other actors/movies
<form action="./search.php" method="GET">Search: <input type="text" name="keyword">
<input type="submit" value="Search">
</form>

</body>
</html>