<?php
include('includes/db.php');

$id         = $_POST['id'];
$secretaria = $_POST['secretaria'];
$sigla      = $_POST['sigla'];
$fone       = $_POST['fone'];
$endereco   = $_POST['endereco'];
$gestor     = $_POST['gestor'];
$email      = $_POST['email'];

$sql = "UPDATE secretarias SET 
                secretaria    = '$secretaria',
                sigla  = '$sigla',
                fone = '$fone',
                endereco = '$endereco',
                gestor = '$gestor',
                email = '$email'
        WHERE id_secretaria = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: secretarias_edi.php?m=1&id=".$id);
    }else{
        header("Location: secretarias_edi.php?m=2&id=".$id);
    }

?>