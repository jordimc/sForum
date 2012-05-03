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
		<h1> sForum - View Topic</h1>
	</header>
	<?php
	include 'config/connection.php';

	//Number of records to show. Pre: [1..*]
	$display = 5;
		
	$errors = FALSE;
	//We retrieve the id of the topic using GET
	if(isset($_GET['id']) && is_numeric($_GET['id'])) 
	{
		$topicid = $_GET['id'];	


		$sql = "SELECT subject FROM tbl_topics WHERE topic_id='$topicid'";
		$result = mysqli_query($connexio, $sql);
	
		if(mysqli_num_rows($result) == 0)
		{
			$errors = TRUE;
			echo 'Error: There is no topic with given id';
		}
		else 
		{
			//There is a row with the given ID. We take the subject.
			$row = mysqli_fetch_array($result, MYSQLI_NUM);
			$subject = $row[0];


			/* If the 'p' (number of pages of the forum) value is set, we take it
			   Otherwise, we calculate it. */
			if(isset($_GET['p']) && is_numeric($_GET['p'])) 
			{
				$pages = $_GET['p'];
			}
			else
			{
				$sql = "SELECT COUNT(reply_id) FROM tbl_replies WHERE reply_topic='$topicid'";
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
				$sql = "SELECT
							reply_id,
							content,
							date,
							username
						FROM
							tbl_replies
						WHERE
							reply_topic='$topicid'
						ORDER BY 
							reply_id ASC LIMIT $start, $display";
		
				$result = mysqli_query($connexio, $sql);
		}
	}
	else 
	{
		$errors = TRUE;
		echo 'Error: This file can not be accessed directly or bad parameter given';
	}
	?>

	<div class="pagination">
		<?php if(!$errors) include 'includes/vt_pagination.php'; ?>
	</div>
	
	<div id=viewMessage>
	<?php
	//We retrieve the id of the topic using GET
	if(!$errors) {
		//Prepare the results table
		echo '<div id="subjectDivisor">';
			echo '<h2>' . $subject . '</h2>';
		echo '</div>';

		echo 	'<table class="tViewTopic">
				<tr class="tViewTopicCategories">
					<th class="tViewAuthor"><h3> Author / Date </h3></th>
					<th class="tViewMessage"><h3> Message </h3></th>
				</tr>';
	
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			echo '<tr>';
				echo '<td>';
					echo '<h4><p>' . $row['username'] . '</p></h4>';
					echo '<p><h5>' . date('d-m-Y', strtotime($row['date'])) . '</h5>';
					echo '<h5>' . date('h:i:s', strtotime($row['date'])) . '</h5></p>';
				echo '</td>';
				echo '<td>';
					echo '<p>' . nl2br($row['content']) . '</p>'; 
				echo '</td>';
			echo '</tr>';	
		}
		echo '</table>';
	
		mysqli_free_result($result);
		mysqli_close($connexio);
	}
	?>
	
	</div>
	<div class="pagination">
		<?php if(!$errors) include 'includes/vt_pagination.php'; ?>
	</div>
	
	<div id="backDivisor">
		<a href="index.php"> :: Go back to the forum Index</a>
	</div>
	
	<div id="addReply">
		<?php include 'create_reply.php'; ?>
	</div>

	<footer>
		- sForum - By Jordi (IchitakaSeto)
	</footer>
</body>
</html>
