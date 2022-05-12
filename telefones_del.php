<?php
include('includes/db.php');

$id                 = $_GET['id'];
$id_departamento    = $_GET['id_departamento'];


$sql = "UPDATE telefones SET 
                ativo    = 'n'
        WHERE id_telefone = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: departamentos_edi.php?m=3&id=".$id_departamento);
    }else{
        header("Location: departamentos_edi.php?m=2id=".$id_departamento);
    }

?>