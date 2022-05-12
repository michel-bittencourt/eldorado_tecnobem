<?php
include('includes/db.php');

$id = $_GET['id'];


$sql = "UPDATE fornecedores SET 
                ativo    = 'n'
        WHERE id_fornec = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: fornecedores_cad.php?m=3");
    }else{
        header("Location: fornecedores_cad.php?m=2");
    }

?>