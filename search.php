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
	}
	if ($keyword){
		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("TEST", $db_connection);
		
		echo "You are searching [".$keyword."] results...<br><br>";

		echo "Searching match records in Actor database ... <br>";
		$query = sprintf("SELECT id, first, last, dob FROM Actor WHERE first LIKE '%%%s%%' OR last LIKE '%%%s%%';",$keyword, $keyword);
		$actors = mysql_query($query, $db_connection);

		$actor = mysql_fetch_row($actors);
		while($actor){
			$date = new DateTime($actor[3]);
			echo "Actor: <a href=\"./showActorInfo.php?id=".$actor[0]."\">".$actor[1].$actor[2]."(".$date->format('Y-m-d').")</a><br>";
			$actor = mysql_fetch_row($actors);
		}



		echo "<br>Searching match records in Movie database ... <br>";
		$query = sprintf("SELECT title, id, year FROM Movie WHERE title LIKE '%%%s%%';",$keyword);
		$movies = mysql_query($query, $db_connection);

		$movie = mysql_fetch_row($movies);
		while($movie){
			echo "Movie: <a href=\"./showMovieInfo.php?id=".$movie[1]."\">".$movie[0]."(".$movie[2].")</a><br>";
			$movie = mysql_fetch_row($movies);
		}
	}
?>
</body></html>