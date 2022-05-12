<?php

	$host 	= "127.0.0.1";
	$user 	= "root";
	$pass 	= "";
	$banco 	= "tecnobem";
	
	//$host 	= "mysql.tecnobem.com.br";
	//$user 	= "tecnobem";
	//$pass 	= "eldorado2021";
	//$banco 	= "tecnobem";

	$conn 	= mysqli_connect($host, $user, $pass) or die (mysqli_error());
	mysqli_select_db($conn, $banco) or die (mysql_error());

	mysqli_set_charset($conn,"utf8");
	

?>