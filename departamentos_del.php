<?php
include('includes/db.php');

$id = $_GET['id'];


$sql = "UPDATE departamentos SET 
                ativo    = 'n'
        WHERE id_departamento = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: departamentos_cad.php?m=3");
    }else{
        header("Location: departamentos_cad.php?m=2");
    }

?>