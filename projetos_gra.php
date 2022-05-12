<?php
include('includes/db.php');

$projeto        = $_POST['projeto'];
$tipo           = $_POST['tipo'];
$id_secretaria  = $_POST['id_secretaria'];
$gestor         = $_POST['gestor'];
$id_status      = $_POST['id_status'];


$sql = "INSERT INTO projetos (
                projeto,
                tipo,
                id_secretaria,
                gestor,
                id_status
            ) VALUES (
                '$projeto',
                '$tipo',
                '$id_secretaria',
                '$gestor',
                '$id_status'
            )";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: projetos_cad.php?m=1");
    }else{
        header("Location: projetos_cad.php?m=2");
    }

?>