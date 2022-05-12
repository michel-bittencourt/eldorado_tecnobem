<?php
require_once("includes/db.php");
session_start();
if (!isset($_SESSION['nome_user']) || !isset($_SESSION['id_user'])) {
    header("Location: index.php?erro=2");
}else{
    $nome_user  = $_SESSION['nome_user'];
    $id_user    = $_SESSION['id_user'];
    $adm        = $_SESSION['adm'];
    $id_sec     = $_SESSION['id_sec'];
    $emp        = 1;
}

$p = explode("/",$_SERVER['PHP_SELF']);
$pag = $p[2];

$sql_acesso = " SELECT A.id_pagina, A.link, B.id_usuario, B.modulo 
                    FROM paginas A, usuario_acesso B
                    WHERE A.link = '$pag'
                    AND B.id_usuario = $id_user
                    AND B.modulo = A.id_pagina
                ";

$result = mysqli_query($conn, $sql_acesso);

require_once("includes/funcoes.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Comunica - Painel de Controle</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-dialog.min.css" rel="stylesheet">
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
        <link href="css/menu.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
                <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


        <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
        <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <!-- <?php /* if ( mysqli_num_rows($result) < 1){header("Location: index.php?erro=3");} */  ?> -->

        <div class="container-fluid">

            <div class="row linha1">
                <div class="col-md-12">

                    <div style="float: left;"><img src="img/brasaop.png" style="width: 25px; margin-right: 15px;"></div>
                    <div style="float: left;"><h3>Prefeitura de Eldorado do Sul</h3></div>

                    <div style="float: right; margin-right: 5px;">
                        <a class="btn btn-light" href="painel.php" target="painel.php">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Página Inicial
                        </a>
                    </div>           

                </div>
            </div>
        
            <div class="row">
              
                <div class="col-md-2">
                    <?php require_once("includes/menu.php"); ?>
                </div>

                <div class="col-md-10">