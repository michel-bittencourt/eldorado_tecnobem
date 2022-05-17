<?php
include ("includes/db.php");
include ("includes/funcoes.php");

$titulo         = filter_input(INPUT_POST, 'titulo'); 
$objeto         = filter_input(INPUT_POST, 'objeto'); 
$id_secretaria  = filter_input(INPUT_POST, 'id_secretaria'); 
$id_tipo        = filter_input(INPUT_POST, 'id_tipo'); 
$id_status      = filter_input(INPUT_POST, 'id_status'); 
$solicitante    = filter_input(INPUT_POST, 'solicitante'); 
$id_resp        = filter_input(INPUT_POST, 'id_resp'); 
$obs            = filter_input(INPUT_POST, 'obs'); 

$sql = "INSERT INTO projetos (
            titulo,
            objeto,
            id_secretaria,
            id_tipo,
            id_status,
            solicitante,
            id_resp,
            obs
        ) VALUES (
            '$titulo',
            '$objeto',
            '$id_secretaria',
            '$id_tipo',
            '$id_status',
            '$solicitante',
            '$id_resp',
            '$obs'
        )";

$conn->query($sql);
$id = mysqli_insert_id($conn);

if(mysqli_affected_rows($conn) != 0){
    gravaLog("Projetos","Gravou",$id);
    header("Location: projetos_cad.php?m=1");
}else{
    header("Location: projetos_cad.php?m=2");
}
?>