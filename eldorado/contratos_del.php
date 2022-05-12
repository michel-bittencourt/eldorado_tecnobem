<?php
include('includes/db.php');

$id = $_GET['id'];


$sql = "UPDATE contratos SET 
                ativo    = 'n'
        WHERE id_contrato = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: contratos_cad.php?m=3");
    }else{
        header("Location: contratos_cad.php?m=2");
    }

?>