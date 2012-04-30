<!DOCTYPE html>
<html lang="en">
<head>
	<title>Basic PHP+MySQL forum - sForum</title>
	<meta name="description" content="Very basic PHP forum" />
	<meta name="author" content="Jordi" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
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
		echo 	'<table class="tIndex">
				<tr class="tIndexCategories">
					<th class="tIndexTopic"><h3> Topic </h3></th>
					<th class="tIndexAuthor"><h3> Author</h3></th>
					<th class="tIndexTime"><h3> Date </h3></th>
				</tr>';
	
		while ($row = mysql_fetch_assoc($result))
		{
			echo '<tr class="tIndexValues">';
				echo '<td class="tIndexTopicName">';
					echo '<h4><a href="viewtopic.php?id=' . $row['topic_id'] . '">' . $row['subject'] . '</a></h4>';
				echo '</td>';
				echo '<td class="tIndexUsername">';
					echo '<h4>' . $row['username'] . '</h4>';
				echo '</td>';
				echo '<td class="tIndexDate">';
					echo '<h4>' . date('d-m-Y h:i:s', strtotime($row['date'])) . '</h4>'; 
				echo '</td>';
			echo '</tr>';	
		}
		echo '</table>';
	}
	mysql_free_result($result);
?>
	<div id="createTopic">
		<?php include 'create_topic.php'; ?>
	</div>
	<footer>
		- sForum - By Jordi (IchitakaSeto)
	</footer>
</body>
</html>

