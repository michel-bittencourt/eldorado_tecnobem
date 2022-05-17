<?php
include ("includes/db.php");
include ("includes/funcoes.php");

$id             = filter_input(INPUT_POST, 'id'); 
$titulo         = filter_input(INPUT_POST, 'titulo'); 
$objeto         = filter_input(INPUT_POST, 'objeto'); 
$id_secretaria  = filter_input(INPUT_POST, 'id_secretaria'); 
$id_tipo        = filter_input(INPUT_POST, 'id_tipo'); 
$id_status      = filter_input(INPUT_POST, 'id_status'); 
$solicitante    = filter_input(INPUT_POST, 'solicitante'); 
$id_resp        = filter_input(INPUT_POST, 'id_resp'); 
$obs            = filter_input(INPUT_POST, 'obs'); 

$sql = "UPDATE projetos SET 
                        titulo='$titulo',
                        objeto='$objeto',
                        id_secretaria='$id_secretaria',
                        id_tipo='$id_tipo',
                        id_status='$id_status',
                        solicitante='$solicitante',
                        id_resp='$id_resp',
                        obs='$obs'
            WHERE id_projeto = $id";

$conn->query($sql);

if(mysqli_affected_rows($conn) != 0){
    gravaLog("Projetos","Alterou",$id);
    header("Location: projetos_edi.php?m=1&id=".$id);
}else{
    header("Location: projetos_edi.php?m=2&id=".$id);
}

?>