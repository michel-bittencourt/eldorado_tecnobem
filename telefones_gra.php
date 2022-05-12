<?php
include('includes/db.php');

$id_departamento    = $_POST['id'];
$tipo               = $_POST['tipo'];
$numero             = $_POST['numero'];
$usuario            = $_POST['usuario'];

$sql = "INSERT INTO telefones (
                id_departamento,
                tipo,
                numero,
                usuario
            ) VALUES (
                '$id_departamento',
                '$tipo',
                '$numero',
                '$usuario'
            )";


    $resultado = mysqli_query($conn, $sql);


    if(mysqli_affected_rows($conn) != 0){
        header("Location: departamentos_edi.php?m=1&id=".$id_departamento);
    }else{
        header("Location: departamentos_edi.php?m=2&id=".$id_departamento);
    }

?>