<?php
include('includes/db.php');

$secretaria = $_POST['secretaria'];
$sigla      = $_POST['sigla'];
$fone       = $_POST['fone'];
$endereco   = $_POST['endereco'];
$gestor     = $_POST['gestor'];
$email      = $_POST['email'];


$sql = "INSERT INTO secretarias (
                secretaria,
                sigla,
                fone,
                endereco,
                gestor,
                email
            ) VALUES (
                '$secretaria',
                '$sigla',
                '$fone',
                '$endereco',
                '$gestor',
                '$email'
            )";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: secretarias_cad.php?m=1");
    }else{
        header("Location: secretarias_cad.php?m=2");
    }

?>