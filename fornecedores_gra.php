<?php
include('includes/db.php');

$fornec     = $_POST['fornec'];
$contato    = $_POST['contato'];
$fone       = $_POST['fone'];
$email      = $_POST['email'];
$obs        = $_POST['obs'];


$sql = "INSERT INTO fornecedores (
                fornec,
                contato,
                fone,
                email,
                obs
            ) VALUES (
                '$fornec',
                '$contato',
                '$fone',
                '$email',
                '$obs'
            )";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: fornecedores_cad.php?m=1");
    }else{
        header("Location: fornecedores_cad.php?m=2");
    }

?>