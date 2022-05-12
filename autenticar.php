<?php
	require_once("includes/db.php");
	$email = $_POST["inputEmail"];
	$senha = $_POST["inputPass"];
	$query = mysqli_query( $conn, "SELECT * FROM usuarios WHERE email = '$email' AND senha ='$senha' ");
	$row   = mysqli_num_rows($query);
	
	$f = mysqli_fetch_array($query);
 
    $nome 	= $f['nome'];
    $id   	= $f['id'];
    $adm   	= $f['adm'];
    $id_sec = $f['id_secretaria'];

	if ($row > 0 ) {
		session_start();
		//$_SESSION['email'] = $_POST['inputEmail'];
		//$_SESSION['senha'] = $_POST['inputPass'];
		$_SESSION['nome_user'] = $nome;
		$_SESSION['id_user'] = $id;
		$_SESSION['adm'] = $adm;
		$_SESSION['id_sec'] = $id_sec;
		header("Location: painel.php");
	}else{
		header("Location: index.php?erro=1");
	}
?>