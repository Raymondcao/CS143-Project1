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
	
		$query = sprintf("SELECT last, first FROM MovieDirector mD, Director D WHERE mid = '%s' AND D.id = mD.did", mysql_real_escape_string($id, $db_connection));
	$rs = mysql_query($query, $db_connection);
	$numrows = mysql_num_rows($rs);
	if($numrows > 0)
	{
		echo "<p><b>Directors:</b><br></p>";
		echo "<ul>";
		for($i = 0; $i < $numrows; $i++)
		{
			$row = mysql_fetch_assoc($rs);
			printf("<li>  %s %s </li>", $row['first'], $row['last']);
		}
		echo "</ul><br>";
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
			printf("<li> <a href=\"showActorInfo.php?id=%s\"> %s %s </a> acting as \"%s\" </li>", $row['id'], $row['first'], $row['last'], $row['role']);
		}
		echo "</ul>";
	}
	
	echo "<h3> User Review </h3>";
	$query = sprintf("SELECT COUNT(*), AVG(rating) FROM Review WHERE mid='%s';", mysql_real_escape_string($id, $db_connection));
	$rs = mysql_query($query, $db_connection);
	$info = mysql_fetch_row($rs);

	echo "Average Score: ".$info[1]."/5 (5.0 is best) by ".$info[0]." reviews(s).<a href=\"./addComment.php?mid=".$id."\">  Add your review now!!</a><br>";
	$query = sprintf("SELECT name, time, rating, comment FROM Review WHERE mid='%s';", mysql_real_escape_string($id, $db_connection));
	$reviews = mysql_query($query, $db_connection);
	$review = mysql_fetch_row($reviews);
	while($review){
		$date = new DateTime($review[1]);
		echo "<font color=\"Blue\">In ".$date->format('Y-m-d h-m-s').", <font color=\"Red\">".$review[0]."</font> said: I rate this move score <font color=\"Red\">".$review[2]."</font> point(s), here is my comment. </font><br>";
		echo $review[3]."<br><br>";
		$review = mysql_fetch_row($reviews);
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