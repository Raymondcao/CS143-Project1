<html>
<head></head>
<body>
FUCKKKKKKK
<?php
	echo "received params: ".$_POST['lastname'].$_POST['firstname'].$_POST['sex'].$_POST['dob'].$_POST['dod']."br>";
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
		echo "<br>Sucess!<br>";
	
	
?>
</body>
</html>