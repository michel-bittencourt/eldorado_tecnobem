<?php
	require_once("includes/db.php");

	$user = filter_input(INPUT_POST, 'user');
	$pass = filter_input(INPUT_POST, 'pass');

	$sql = "SELECT * FROM usuarios WHERE email = '$user'";
	$result = $conn->query($sql);

    if($f=$result->fetch_assoc()){
		$nome 		= $f['nome'];
		$id   		= $f['id'];
		$senhadb  	= $f['senha'];
	
		if ($pass == $senhadb) {

			session_start();
			$_SESSION['nome_user'] = $nome;
			$_SESSION['id_user'] = $id;
			include("includes/funcoes.php");
			gravaLog("Acesso ao sistema","Login",$id);
			header("Location: painel.php");
		}else{
			header("Location: index.php?erro=1");
		}
	}else{
		header("Location: index.php?erro=1");
	}
?>