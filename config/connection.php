<?php
    //Arxiu de configuració de la connexió a la Base de Dades
    //Actualment preparat per localhost
    
    $host = "";		 //Ex: "localhost"
	$username = "";  		//Ex: "root"
	$password = "";
	$dbname = "";			//Ex: "sForum"
	
	##### Fem la connexió #####
	$connexio = mysqli_connect($host, $username, $password) or die('MySQL connection failure');
	$db = mysqli_select_db($connexio, $dbname) or die ('Could not connect to DataBase');
?>
