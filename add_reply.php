<?php

//Connexio a la BDD
include 'config/connection.php';


if($_SERVER['REQUEST_METHOD'] != 'POST') 
{
	echo 'Error: The file can not be called directly';
}
else
{

	if(isset($_POST['topic_id']) && is_numeric($_POST['topic_id']) && $_POST['topic_id'] >= 0)
	{
		$topicid = (int) $_POST['topic_id'];


		//Recollim les dades de post. Fem typecasting sobre topicid per assegurar integer
		$content = mysql_real_escape_string($_POST['message']);
		$username = mysql_real_escape_string($_POST['username']);
	
		//Prevenció d'atacs XSS, fem servir strip_tags() per 
		// eliminar els tags HTML o PHP que l'usuari pugui introduir
		$content = htmlspecialchars(strip_tags($content));
		$username = htmlspecialchars(strip_tags($username));
	

		//Data del servidor en el moment de la resposta...
		$datetime = date("d/m/y h:i:s");
	
	
		$sql = "INSERT INTO tbl_replies (
					content,
					date,
					reply_topic,
					username)
				VALUES (
					'$content',
					'$datetime',
					'$topicid',
					'$username')";
				
		$result = mysql_query($sql);
	
		if(!$result)
		{
			echo 'There was some error while inserting the new reply';
		}
		else
		{
			header ("Location: viewtopic.php?id=$topicid");
		}
	}
	else echo 'Topic ID incorrect.'; 
}



?>
