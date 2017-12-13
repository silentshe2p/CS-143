<html>
<head><title>CS143 Project 1A</title></head>
<body>

<h1>Project 1A</h1>
<p>Input a SQL query in the following box:</p>

<p>
	<form method="GET" action="query.php">
		<textarea name="query" cols="60" rows="8"><?php echo $_GET["query"];?></textarea><br/>
		<input type="submit" value="Submit" />
	</form>
</p>

<p><small>Note: tables and fields are case-sensitive.</small></p>

<?php
	$query = $_GET["query"];
	if (!empty($query)) {
		$db_connection = mysql_connect ("localhost", "cs143", "")
			or die ("Could not connect: ".mysql_error());

		mysql_select_db ("CS143", $db_connection)
			or die ("Could not select database".mysql_error());

		$rs = mysql_query($query, $db_connection)
			or die ("Query failed: ".mysql_error());

		echo "<h3>", "Result from MySQL:", "</h3>";

		echo "<table border=1 cellspacing=1 cellpadding=2>";
		$row = mysql_fetch_field($rs);
		echo "<tr>";
		for ($i = 0; $i < mysql_num_fields($rs); $i++)
			echo "<th>", mysql_fetch_field($rs, $i)->name, "</th>";
		echo "</tr>";

		while ($row = mysql_fetch_row($rs)) {
			echo "<tr>";
			for ($i = 0; $i < mysql_num_fields($rs); $i++)
				echo "<td>", $row[$i], "</td>";
			echo "</tr>";
		}
		echo "</table>";
		mysql_free_result($rs);
		mysql_close($db);
	}
?>

</body>
</html>