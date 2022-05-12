<?php
include('includes/db.php');

$id_projeto = $_POST['id_projeto'];
$tabela     = $_POST['tabela'];
$descri     = $_POST['descri'];


$sql = "INSERT INTO $tabela (
                id_projeto,
                descri
            ) VALUES (
                '$id_projeto',
                '$descri'
            )";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: projetos_edi.php?m=1&id=".$id_projeto);
    }else{
        header("Location: projetos_edi.php?m=2&id=".$id_projeto);
    }

?>