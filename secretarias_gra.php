<?php
include ("includes/db.php");
include ("includes/funcoes.php");

$secretaria     = filter_input(INPUT_POST, 'secretaria'); 
$sigla          = strtoupper(filter_input(INPUT_POST, 'sigla')); 
$fone           = filter_input(INPUT_POST, 'fone'); 
$endereco       = filter_input(INPUT_POST, 'endereco'); 
$gestor         = filter_input(INPUT_POST, 'gestor'); 
$email          = filter_input(INPUT_POST, 'email'); 

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

$conn->query($sql);
$id = mysqli_insert_id($conn);

if(mysqli_affected_rows($conn) != 0){
    gravaLog("Secretarias","Gravou",$id);
    header("Location: secretarias_cad.php?m=1");
}else{
    header("Location: secretarias_cad.php?m=2");
}
?>