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
			echo '<h2>' . $subject[0] . '</h2>';
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
			echo 	'<table class="tViewTopic">
					<tr class="tViewTopicCategories">
						<th class="tViewAuthor"><h3> Author / Date </h3></th>
						<th class="tViewMessage"><h3> Message </h3></th>
					</tr>';
			
			while ($row = mysql_fetch_assoc($result))
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
		}
	}
	
?>
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
