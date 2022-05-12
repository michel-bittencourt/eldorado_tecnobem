<?php
require_once("includes/db.php");
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
  header("Location: index.php?erro=2");
}else{
  $nome_user = $_SESSION['nome_user'];
  $id_user   = $_SESSION['id_user'];
  $adm        = $_SESSION['adm'];
  $id_sec     = $_SESSION['id_sec'];  
  $emp       = 1;
}

require_once("includes/funcoes.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>Painel de Controle - Sismob</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-dialog.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
    <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">

      <div class="row linha1">
        <div class="col-md-12">
          <div style="float: left;">
            <h3>SISMOB - Sistema de Gestão Imobiliária</h3>
          </div>
          <div style="float: right;">
            Usuário: <?=$nome_user?>
          </div>
        </div>
        
      </div>
      
      <div class="row" style="margin-left: 10px;">
            
        <div class="col-md-12">