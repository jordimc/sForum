<!DOCTYPE html>
<html lang="en">
<head>
	<title> sForum - Basic PHP+MySQL Board Messages </title>
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
	<?php
	include 'config/connection.php';
	
	//Number of records to show. Pre: [1..*]
	$display = 5;			
	
	
	/* If the 'p' (number of pages of the forum) value is set, we take it
	   Otherwise, we calculate it. */
	if(isset($_GET['p']) && is_numeric($_GET['p'])) 
	{
		$pages = $_GET['p'];
	}
	else
	{
		$sql = "SELECT COUNT(topic_id) FROM tbl_topics";
		$result = mysqli_query($connexio, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		$records = $row[0];
	
		/* Number of pages needed */
		if($records > $display) 
		{
			//More than 1 page...
			$pages = ceil($records/$display);
		}
		else
		{
			$pages = 1;
		}
	}
	
	/* Starting point of the query */
	if(isset($_GET['start']) && is_numeric($_GET['start']))
	{
		$start = $_GET['start'];
	}
	else
	{
		$start = 0;
	}
	
	if($pages > 1) 
	{
		$current_page = ceil($start/$display)+1;
	}
	else
	{
		$current_page = 1;
	}
	
	/* Make the query between the range given */
	$sql = "SELECT * FROM tbl_topics ORDER BY topic_id DESC LIMIT $start, $display";
	$result = mysqli_query($connexio, $sql);
		
	?>

	<div class="pagination">
		<?php include 'includes/pagination.php'; ?>
	</div>
	<div id="posts">

	<?php

	if(mysqli_num_rows($result) == 0) 
	{
		echo '<h3>There are no topics in this forum</h3>';
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
	
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
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
	mysqli_free_result($result);
	mysqli_close($connexio);
	?>
	</div>
	<div class="pagination">
		<?php include 'includes/pagination.php'; ?>
	</div>
	<div id="createTopic">
		<?php include 'create_topic.php'; ?>
	</div>
	<footer>
		- sForum - By Jordi (IchitakaSeto)
	</footer>
</body>
</html>

