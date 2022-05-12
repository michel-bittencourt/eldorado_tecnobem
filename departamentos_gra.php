<?php
include('includes/db.php');

$id_secretaria  = $_POST['id_secretaria'];
$departamento   = $_POST['departamento'];


$sql = "INSERT INTO departamentos (
                id_secretaria,
                departamento
            ) VALUES (
                '$id_secretaria',
                '$departamento'
            )";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: departamentos_cad.php?m=1");
    }else{
        header("Location: departamentos_cad.php?m=2");
    }

?>