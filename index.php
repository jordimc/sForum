<!DOCTYPE html>
<html lang="en">
<head>
	<title>Basic PHP+MySQL forum - sForum</title>
	<meta name="description" content="Very basic PHP forum" />
	<meta name="author" content="Jordi" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
</head>
<body>
	<header>
		<h1> sForum - Index</h1>
	</header>
	<div id="posts">
<?php
	include 'config/connection.php';
	
	$sql = "SELECT * FROM tbl_topics ORDER BY topic_id DESC";
	$result = mysql_query($sql);

	if(mysql_num_rows($result) == 0) 
	{
		echo 'There are no topics in this forum';
	}
	else 
	{
		//Prepare the results table
		echo 	'<table width="90%" border="1" align="center">
				<tr>
					<th>Topic</th>
					<th>Author</th>
					<th>Time</th>
				</tr>';
	
		while ($row = mysql_fetch_assoc($result))
		{
			echo '<tr>';
				echo '<td>';
					echo '<h3><a href="viewtopic.php?id=' . $row['topic_id'] . '">' . $row['subject'] . '</a></h3>';
				echo '</td>';
				echo '<td>';
					echo $row['username'];
				echo '</td>';
				echo '<td>';
					echo date('d-m-Y h:i:s', strtotime($row['date'])); 
				echo '</td>';
			echo '</tr>';	
		}
		echo '</table>';
	}
	mysql_free_result($result);
?>
	</div>
	<?php include 'create_topic.php'; ?>
	<footer>
		- sForum -
	</footer>
</body>
</html>

