
<html>
<head>
<link rel="stylesheet" type="text/css" href="mainframe.css"></head>
<body>
<form method="post">
Title: <input type="text" name="title"><br><br>
Year: <input type="text" name="year"><br><br>
Company: <input type="text" name="company"><br><br>
Rating:
<select name="rating">
  <option value="G">G</option>
  <option value="NC-17">NC-17</option>
  <option value="PG-13">PG-13</option>
  <option value="PG">PG</option>
  <option value="R">R</option>
  <option value="Surrendere">Surrendere</option>
</select>
<br><br>
<input type="checkbox" name = "Action" value="1"> Action
<input type="checkbox" name = "Adult" value="1"> Adult
<input type="checkbox" name = "Adventure" value="1"> Adventure
<input type="checkbox" name = "Comedy" value="1"> Comedy
<input type="checkbox" name = "Crime" value="1">Crime
<input type="checkbox" name = "Documentary" value="1"> Documentary
<input type="checkbox" name = "Drama" value="1"> Drama
<input type="checkbox" name = "Family" value="1"> Family
<input type="checkbox" name = "Fantasy" value="1"> Fantasy
<input type="checkbox" name = "Horror" value="1"> Horror
<input type="checkbox" name = "Musical" value="1"> Musical
<input type="checkbox" name = "Mystery" value="1">Mystery
<input type="checkbox" name = "Romance" value="1">Romance
<input type="checkbox" name = "Sci-Fi" value="1">Sci-Fi
<input type="checkbox" name = "Short" value="1">Short
<input type="checkbox" name = "Thriller" value="1">Thriller
<input type="checkbox" name = "War" value="1">War
<input type="checkbox" name = "Western" value="1">Western
<br><br>
<input type="submit" value="Submit"/>
</form>
<hr>
<?php 
if($_POST['title'] && $_POST['year'] && $_POST['company'] && $_POST['rating'])
{
//echo "<br>trying to establish connection<br>";
	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("TEST", $db_connection);
	$rs = mysql_query("SELECT * FROM MaxMovieID", $db_connection);
	$row = mysql_fetch_row($rs);
	$id = $row[0];
	//echo "received id = $id<br>";
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
		echo "<br><h3>Success</h3><br>";
	$genres = array( 'Action', 'Adult', 'Adventure' ,'Animation' ,'Comedy' ,'Crime' ,'Documentary' ,'Drama', 'Family' ,'Fantasy' ,'Horror' ,'Musical' ,'Mystery' ,'Romance' , 'Sci-Fi' ,'Short', 'Thriller', 'War', 'Western');
	$len = count($genres);
	for($i = 0; $i < $len; $i++)
	{
		if(isset($_POST[$genres[$i]]))
		{
			$query = sprintf("INSERT INTO MovieGenre VALUES('%s', '%s')", $id, $genres[$i] );
			$rs = mysql_query($query, $db_connection);
				$affected = mysql_affected_rows($db_connection);
				//if($affected > 0)
				//echo "<br>Success for genre". $genres[$i] ."<br>";
		}
	}
	mysql_close($db_connection);
}
?>
</body>
</html>