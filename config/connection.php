<?php
    //Arxiu de configuració de la connexió a la Base de Dades
    //Actualment preparat per localhost
    
    $host = "";		 		//Ex: "localhost"
	$username = "";  		//Ex: "root"
	$password = "";
	$dbname = "";			//Ex: "sForum"
	
	##### Fem la connexió #####
	$connexio = mysql_connect($host, $username, $password) or die('MySQL connection failure');
	$db = mysql_select_db($dbname) or die ('Could not connect to DataBase');
?>
