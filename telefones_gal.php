<?php
include('includes/db.php');

$id                 = $_POST['id'];
$id_departamento    = $_POST['id_departamento'];
$tipo               = $_POST['tipo'];
$numero             = $_POST['numero'];
$usuario            = $_POST['usuario'];

$sql = "UPDATE telefones SET 
                tipo            = '$tipo',
                numero          = '$numero', 
                usuario         = '$usuario'
        WHERE id_telefone = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: departamentos_edi.php?m=1&id=".$id_departamento);
    }else{
        header("Location: departamentos_edi.php?m=2&id=".$id_departamento);
    }

?>