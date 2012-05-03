<?php

//Connexió a la BDD
include 'config/connection.php';


if($_SERVER['REQUEST_METHOD'] != 'POST') 
{
	echo 'Error: The file can not be called directly';
}
else 
{
	//Recollim les dades per POST (prevenint SQL injection)
	$subject = mysql_real_escape_string($_POST['subject']);
	$message = mysql_real_escape_string($_POST['message']);
	$username = mysql_real_escape_string($_POST['username']);

	//Prevenció d'atacs XSS, fem servir strip_tags() per 
	// eliminar els tags HTML o PHP que l'usuari pugui introduir
	$subject = htmlspecialchars(strip_tags($subject));
	$message = htmlspecialchars(strip_tags($message));
	$username = htmlspecialchars(strip_tags($username));

	//La data d'enviament...
	$datetime = date("d/m/y h:i:s");


	$sql = "INSERT INTO tbl_topics (
				subject,
				date,
				username)
			VALUES (
				'$subject',
				'$datetime',
				'$username')";
	
	$result = mysql_query($sql);
	
	if(!$result)
	{
		echo 'There was some error while inserting the new topic.';
	}
	else
	{
		//Inserted the topic, now let's add the message as the first of the replies
		//First, we get the id of the created topic...
		$topicid = mysql_insert_id();
		
		$sql = "INSERT INTO tbl_replies (
					content,
					date,
					reply_topic,
					username)
				VALUES (
					'$message',
					'$datetime',
					'$topicid',
					'$username')";
		
		$result = mysqli_query($connexio, $sql);
		
		mysqli_free_result($result);
		mysqli_close($connexio);
		
		if(!$result)
		{
			echo 'There was some error while inserting the reply';
		}
		else
		{
			header ("Location: viewtopic.php?id=$topicid");
		}
	}
}

?>
