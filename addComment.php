<html><head>
		<title>add comment</title>
		<style type="text/css">
		@import url(cs143style.css);
		</style>
	</head>	
	<body>
		Add new comment: <br>
		<form action="./addComment.php" method="GET">			
			Movie:	<select name="mid">
					<?php 
					$db_connection = mysql_connect("localhost", "cs143", "");
					mysql_select_db("CS143", $db_connection);
					$query = sprintf("SELECT title, year FROM Movie WHERE id='%s';",
					 							 mysql_real_escape_string($_GET['mid'], $db_connection));
					$movies = mysql_query($query, $db_connection);
					$movie = mysql_fetch_row($movies);

					echo "<option value=\"".$_GET['mid']."\" selected=\"selected\">".$movie[0]."(".$movie[1].")</option>" ?>
					mysql_close($db_connection);

					</select>
			<br>
			Your Name:	<input type="text" name="yourname" value="Mr. Anonymous" maxlength="20"><br>
			Rating:	<select name="rating">
						<option value="5"> 5 - Excellent </option>
						<option value="4"> 4 - Good </option>
						<option value="3"> 3 - It's ok~ </option>
						<option value="2"> 2 - Not worth </option>
						<option value="1"> 1 - I hate it </option>
					</select>
			<br>
			Comments: <br>
			<textarea name="comment" cols="80" rows="10"></textarea>
			<br>
			<input type="submit" value="Rate it!!">
		</form>
		<hr>

<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['rating']){
	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("CS143", $db_connection);

	$query = sprintf("INSERT INTO Review VALUES('%s', now(), '%s', '%s', '%s')",
							 mysql_real_escape_string($_GET['yourname'], $db_connection),
							mysql_real_escape_string($_GET['mid'], $db_connection),
							mysql_real_escape_string($_GET['rating'], $db_connection),
							mysql_real_escape_string($_GET['comment'], $db_connection)
						);
	$rs = mysql_query($query, $db_connection);
	$affected = mysql_affected_rows($db_connection);
	if($affected > 0){
		echo "<font color=\"Red\"><b>Thanks your comment!! We appreciate it!!</b></font><br>";
		echo "<a href=\"./showMovieInfo.php?id=".$_GET['mid']."\">See Movie Info (including others' reviews)</a>";

	}
	mysql_close($db_connection);
}
?>
	

</body></html>