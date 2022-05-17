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

$sql_user = "SELECT foto FROM usuarios WHERE id = $id_user";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();

if($row_user['foto'] == ""){
    $foto = "avatar5.png";
}else{
    $foto = $row_user['foto'];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prefeitura de Eldorado do Sul || Painel de Controle</title>
    <link rel="shortcut icon" href="dist/img/favicon.ico" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="./painel.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contato</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Informe o número do contrato" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="./painel.php" class="brand-link">
            <img src="./dist/img/logo.png" alt="Prefeitura de Eldorado do Sul Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Prefeitura de Eldorado</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="./dist/img/<?=$foto?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?=$nome?></a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="painel.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Painel de Controle
                                
                            </p>
                        </a>
                    </li>
                    <?php 
                    $sql_mod = "SELECT A.id_usuario, A.id_pagina, B.id_modulo, B.pagina, C.id_modulo, C.class, C.modulo 
                                FROM usuario_acesso A, paginas B, modulos C 
                                WHERE B.ativo = 's'
                                AND A.id_usuario = $id_user
                                AND A.id_pagina = B.id_pagina
                                AND B.id_modulo = C.id_modulo                            
                                GROUP BY C.id_modulo
                                ORDER BY C.ordem";
                    $result_modulos = $conn->query($sql_mod);

                    while ($row_modulos = $result_modulos->fetch_assoc()) { ?>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon <?=$row_modulos['class']?>"></i>
                            <p>
                                <?=$row_modulos['modulo']?> 
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <?php
                            $id_modulo = $row_modulos['id_modulo'];
                            $sql_pag = "SELECT A.id_pagina, A.pagina, A.link 
                                        FROM paginas A, usuario_acesso B 
                                        WHERE A.id_modulo = $id_modulo 
                                        AND A.ativo = 's'
                                        AND A.id_pagina = B.id_pagina
                                        AND B.id_usuario = $id_user
                                        ORDER BY A.pagina
                                        ";

                            $result_pag = $conn->query($sql_pag);

                            while ($row_pag = $result_pag-> fetch_assoc()) { ?>


                            <li class="nav-item ml-3">
                                <a href="<?=$row_pag['link']?>" class="nav-link">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p><?=$row_pag['pagina']?></p>
                                </a>                                
                            </li>


                            <?php } ?>
                          
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a href="logoff.php" class="nav-link">
                            <i class="nav-icon fas fa-door-open"></i>
                            <p>Sair do sistema</p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    
