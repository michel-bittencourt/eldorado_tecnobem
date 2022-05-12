<?php
include('includes/db.php');

$id             = $_POST['id'];
$id_secretaria  = $_POST['id_secretaria'];
$id_fornec      = $_POST['id_fornec'];
$numero         = $_POST['numero'];
$data_ini       = $_POST['data_ini'];
$data_fim       = $_POST['data_fim'];
$fiscal         = $_POST['fiscal'];
$objeto         = $_POST['objeto'];
$prorrog        = $_POST['prorrog'];
$data_prorrog   = $_POST['data_prorrog'];

$sql = "UPDATE contratos SET 
                id_secretaria   = '$id_secretaria',
                id_fornec       = '$id_fornec',
                numero          = '$numero',
                data_ini        = '$data_ini',
                data_fim        = '$data_fim',
                fiscal          = '$fiscal',
                objeto          = '$objeto',
                prorrog         = '$prorrog',
                data_prorrog    = '$data_prorrog'                 
        WHERE id_contrato = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: contratos_edi.php?m=1&id=".$id);
    }else{
        header("Location: contratos_edi.php?m=2&id=".$id);
    }

?>