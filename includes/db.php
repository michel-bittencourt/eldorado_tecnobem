<?php

	//$host 	= "localhost";
	//$user 	= "root";
	//$pass 	= "";
	//$banco 	= "eldorado";
	
	$host 	= "mysql.tecnobem.com.br";
	$user 	= "tecnobem01";
	$pass 	= "Dti2021";
	$banco 	= "tecnobem01";

	$conn 	= mysqli_connect($host, $user, $pass) or die (mysqli_error());
	mysqli_select_db($conn, $banco) or die (mysql_error());

	mysqli_set_charset($conn,"utf8");
	

?>