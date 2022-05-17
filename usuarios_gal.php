<?php
include ("includes/db.php");

$id         = $_POST['id'];
$nome       = filter_input(INPUT_POST, 'nome_user'); 
$usuario    = filter_input(INPUT_POST, 'login_user'); 
$senha      = filter_input(INPUT_POST, 'senha_user'); 

$modulos    = $_POST['acesso'];

if($senha != ""){
    $nova_senha = password_hash($senha, PASSWORD_DEFAULT);
    $senha = "senha = '".$nova_senha."', ";
}else{
    $senha = "";
}

$sql = "UPDATE usuarios SET 
            $senha
            usuario         = '$nome',
            login           = '$usuario'
        WHERE 
            id_usuario = '$id'";


$conn->query($sql);

$sql_limpa = "DELETE FROM usuario_acesso WHERE id_usuario = '$id'";
$query_limpa = $conn->query($sql_limpa);

foreach ($modulos as $acesso) {
    $sql2= "INSERT INTO usuario_acesso(id_usuario, id_pagina) VALUES ('$id','$acesso')";
    $query = $conn->query($sql2);
}

if(mysqli_affected_rows($conn) != 0){
    header("Location: usuarios_edi.php?m=1&id=".$id);
}else{
    header("Location: usuarios_edi.php?m=2&id=".$id);
}

?>