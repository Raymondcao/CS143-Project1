<html>
<head><title>CS143 Project 1B</title></head>
<body>
Type an SQL query in the following box: <p>
Example: <tt>SELECT * FROM Actor WHERE id=10;</tt><br />
<p>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
<textarea name="query" cols="60" rows="8"></textarea><br />
<input type="submit" value="Submit" />
</form>

<?php

	if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$userQuery = $_GET['query'];
	}

	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("CS143", $db_connection);

	$rs = mysql_query($userQuery, $db_connection);

	print "<table border=1 cellspacing=1 cellpadding=2>";

	$row = mysql_fetch_assoc($rs);
	print "<tr align=center>";

	foreach($row as $name=>$value){
		print "<td>$name</td>";
	}
	print "</tr>";

	while($row){
		print "<tr align=center>";
		$countRow = count($row);

		foreach($row as $value){
			if ($value){
				print "<td>$value</td>";
			}else{
				print "<td>N/A</td>";				
			}
		}
		print "</tr>";
		$row = mysql_fetch_row($rs);
	}

	print "</table>";

	mysql_close($db_connection);
?>


</p>
<p><small>Note: tables and fields are case sensitive. All tables in Project 1B are availale.</small>
</p>


</body>
</html>

