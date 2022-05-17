<?php
include ("includes/db.php");

$nome       = filter_input(INPUT_POST, 'nome_user'); 
$usuario    = filter_input(INPUT_POST, 'login_user'); 
$senha      = filter_input(INPUT_POST, 'senha_user'); 

$hashSenha = password_hash($senha, PASSWORD_DEFAULT);

$id_emp         = 1;
$id_usuario     = $id_user;
$data_cad       = date("Y/m/d");

$sql = "INSERT INTO usuarios (
                usuario,
                login,
                senha      
            ) VALUES (
                '$nome',
                '$usuario',
                '$hashSenha'
            )";

$conn->query($sql);


if(mysqli_affected_rows($conn) != 0){
    header("Location: usuarios_cad.php?m=1");
}else{
    header("Location: usuarios_cad.php?m=2");
}

?>