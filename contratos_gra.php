<?php
include('includes/db.php');

$id_secretaria  = $_POST['id_secretaria'];
$id_fornec      = $_POST['id_fornec'];
$numero         = $_POST['numero'];
$data_ini       = $_POST['data_ini'];
$data_fim       = $_POST['data_fim'];
$fiscal         = $_POST['fiscal'];
$objeto         = $_POST['objeto'];
$prorrog        = $_POST['prorrog'];
$data_prorrog   = $_POST['data_prorrog'];
$dias_antec     = $_POST['dias_antec'];

$sql = "INSERT INTO contratos (
                id_secretaria,
                id_fornec,
                numero,
                data_ini,
                data_fim,
                fiscal,
                objeto,
                prorrog,
                data_prorrog,
                dias_antec
            ) VALUES (
                '$id_secretaria',
                '$id_fornec',
                '$numero',
                '$data_ini',
                '$data_fim',
                '$fiscal',
                '$objeto',
                '$prorrog',
                '$data_prorrog',
                '$dias_antec'           
            )";


    $resultado = mysqli_query($conn, $sql);

    $id_processo = mysqli_insert_id($conn);

    $dir = "anexos/contratos/".$id_processo;
    if(!is_dir($dir)){ 
        mkdir($dir,0755,true);
    }

    $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
    for ($controle = 0; $controle < count($arquivo['name']); $controle++){
        $destino = $dir."/".$arquivo['name'][$controle];
        move_uploaded_file($arquivo['tmp_name'][$controle], $destino);
        $titulo_arquivo = $arquivo['name'][$controle];
        $sql_anexo = "INSERT INTO contratos_anexos (id_contrato,titulo_arquivo) 
                      VALUES ('$id_processo', '$titulo_arquivo')";
        mysqli_query($conn, $sql_anexo); 
    }    

    if(mysqli_affected_rows($conn) != 0){
        header("Location: contratos_cad.php?m=1");
    }else{
        header("Location: contratos_cad.php?m=2");
    }
?>