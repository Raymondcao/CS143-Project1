
<html>
<head>
<link rel="stylesheet" type="text/css" href="mainframe.css">
</head>
<body>
<form method="post">
Identity:  <input type="radio" name="identity" value="Actor" checked>Actor  <input type="radio" name="identity" value="Director">Director <br><br>
First name: <input type="text" name="firstname"><br><br>
Last name: <input type="text" name="lastname"><br><br>
Sex: <input type="radio" name="sex" value="Male">Male  <input type="radio" name="sex" value="Female">Female<br><br>
DOB: <input type="text" name="dob"><br><br>
DOD: <input type="text" name="dod"><br><br>
<input type="submit" value="Submit"/><br>

</form>
<hr>
<?php
	if($_POST['lastname'] && $_POST['firstname'] && $_POST['sex'] && $_POST['dob'])
	{
	echo "<br>trying to establish connection<br>";
	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("TEST", $db_connection);
	$rs = mysql_query("SELECT * FROM MaxPersonID", $db_connection);
	$row = mysql_fetch_row($rs);
	$id = $row[0];
	echo "received id = $id<br>";
	$id++;
	mysql_query("UPDATE MaxPersonID SET id=id+1", $db_connection);
	$query = "";
	$dod = "NULL";
	if(!empty($_POST['dod']))
		$dod =  mysql_real_escape_string($_GET['dod'], $db_connection);
	
	
	if($_POST['identity'] == 'Actor')
		$query = sprintf("INSERT INTO Actor VALUES ('%s','%s', '%s', '%s', '%s', '%s')",
		mysql_real_escape_string($id, $db_connection),
		 mysql_real_escape_string($_POST['lastname'], $db_connection),
		 mysql_real_escape_string($_POST['firstname'], $db_connection),  
		   mysql_real_escape_string($_POST['sex'], $db_connection), 
		    mysql_real_escape_string($_POST['dob'], $db_connection), 
			 $dod
			); 
	else
		$query = sprintf("INSERT INTO Actor VALUES ('%s','%s', '%s', '%s', '%s', '%s')",
		mysql_real_escape_string($id, $db_connection),
		mysql_real_escape_string($_POST['lastname'], $db_connection), 
		 mysql_real_escape_string($_POST['firstname'], $db_connection), 
		    mysql_real_escape_string($_POST['dob'], $db_connection), 
			$dod
			);
	
	$rs = mysql_query($query, $db_connection);
	$affected = mysql_affected_rows($db_connection);
	if($affected > 0)
		echo "<br>Success!<br>";
	mysql_close($db_connection);
	}
?>

</body>
</html>

