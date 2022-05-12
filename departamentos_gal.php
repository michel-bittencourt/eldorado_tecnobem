<?php
include('includes/db.php');

$id             = $_POST['id'];
$id_secretaria  = $_POST['id_secretaria'];
$departamento   = $_POST['departamento'];

$sql = "UPDATE departamentos SET 
                id_secretaria = '$id_secretaria',
                departamento  = '$departamento'
        WHERE id_departamento = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: departamentos_edi.php?m=1&id=".$id);
    }else{
        header("Location: departamentos_edi.php?m=2&id=".$id);
    }

?>