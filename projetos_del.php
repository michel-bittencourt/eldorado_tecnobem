<?php
include('includes/db.php');

$id         = $_GET['id'];


$sql = "UPDATE projetos SET 
                ativo    = 'n'
        WHERE id_projeto = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: projetos_cad.php?m=3");
    }else{
        header("Location: projetos_cad.php?m=2");
    }

?>