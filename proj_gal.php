<?php
include('includes/db.php');

$id         = $_POST['id'];
$id_projeto = $_POST['id_projeto'];
$tabela     = $_POST['tabela'];
$descri     = $_POST['descri'];


$sql = "UPDATE $tabela SET descri = '$descri' WHERE id = $id";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: projetos_edi.php?m=1&id=".$id_projeto);
    }else{
        header("Location: projetos_edi.php?m=2&id=".$id_projeto);
    }

?>