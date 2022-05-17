<?php  
session_start();
if(isset($_SESSION['nome_user'])){
    $nome       = $_SESSION['nome_user'];
    $id_user    = $_SESSION['id_user'];
}else{
    header("Location: index.php?erro=1");
}

header("Content-type: text/html; charset=utf-8");
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$hoje = strftime(' %d de %B de %Y', strtotime('today'));

include("includes/db.php");
include("includes/funcoes.php");

$sql_user = "SELECT foto FROM usuarios WHERE id_usuario = $id_user";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();

if($row_user['foto'] == ""){
    $foto = "user2-160x160.jpg";
}else{
    $foto = $row_user['foto'];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Casca Corretora || Painel de Controle</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper text-center" style="margin: 20px;">


    
