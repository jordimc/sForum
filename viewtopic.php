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
	<div id=viewMessage>
<?php
	include 'config/connection.php';
	
	//We retrieve the id of the topic using GET
	$topicid = (int) mysql_real_escape_string($_GET['id']);
	
	$sql = "SELECT subject FROM tbl_topics WHERE topic_id='$topicid'";
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result) == 0)
	{
		echo 'Error: There is no topic with this id';
	}
	else 
	{
		//We found a topic so we show the subject
		$subject = mysql_fetch_array($result);
		//Prepare the results table

		echo '<div id="subject">';
			echo '<h3>Subject: ' . $subject[0] . '</h3>';
		echo '</div>';
		//Now let's retrieve all the replies
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
					reply_id ASC";
		
		$result = mysql_query($sql);
		if(mysql_num_rows($result) == 0)
		{
			echo 'Error: no replies to this topic id';
		}
		else
		{
			echo 	'<table width="90%" border="1" align="center">';
			
			while ($row = mysql_fetch_assoc($result))
			{
				echo '<tr>';
					echo '<td>';
						echo '<p>' . $row['username'] . ' </p>';
						echo date('d-m-Y h:i:s', strtotime($row['date']));
					echo '</td>';
					echo '<td>';
						echo $row['content']; 
					echo '</td>';
				echo '</tr>';	
			}
			echo '</table>';
		}
	}
	
?>
	</div>
	<?php include 'create_reply.php'; ?>
	<a href="index.php">Go back to the forum index</a>
	<footer>
		- sForum -
	</footer>
</body>
</html>
