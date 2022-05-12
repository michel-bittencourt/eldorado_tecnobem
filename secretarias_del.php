<?php
include('includes/db.php');

$id         = $_GET['id'];


$sql = "UPDATE secretarias SET 
                ativo    = 'n'
        WHERE id_secretaria = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: secretarias_cad.php?m=3");
    }else{
        header("Location: secretarias_cad.php?m=2");
    }

?>