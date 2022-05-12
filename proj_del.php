<?php
include('includes/db.php');

$id         = $_GET['id'];
$tabela     = $_GET['tabela'];
$id_projeto = $_GET['id_projeto'];


$sql = "UPDATE $tabela SET 
                ativo    = 'n'
        WHERE id = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: projetos_edi.php?m=3&id=".$id_projeto);
    }else{
        header("Location: projetos_edi.php?m=2&id=".$id_projeto);
    }

?>