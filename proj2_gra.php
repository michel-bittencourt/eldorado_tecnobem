<?php
include('includes/db.php');

$projeto        = $_POST['projeto'];
$id_secretaria  = $_POST['id_secretaria'];
$inicio         = $_POST['inicio'];
$fim            = $_POST['fim'];
$gestor         = $_POST['gestor'];
$responsavel    = $_POST['responsavel'];
$descricao      = $_POST['descricao'];
$objetivos      = $_POST['objetivos'];
$cenario        = $_POST['cenario'];
$justificativa  = $_POST['justificativa'];
$estrategia     = $_POST['estrategia'];
$qtd_pessoas    = $_POST['qtd_pessoas'];
$id_status      = $_POST['id_status'];
$iteracoes      = $_POST['iteracoes'];
$envolvidos     = $_POST['envolvidos'];
$orcamento      = $_POST['orcamento'];
$obs            = $_POST['obs'];

$sql = "INSERT INTO projetos2 (
                projeto,
                id_secretaria,
                inicio,
                fim,
                gestor,
                responsavel,
                descricao,
                objetivos,
                cenario,
                justificativa,
                estrategia,
                qtd_pessoas,
                id_status,
                iteracoes,
                envolvidos,
                orcamento,
                obs
            ) VALUES (
                '$projeto',
                '$id_secretaria',
                '$inicio',
                '$fim',
                '$gestor',
                '$responsavel',
                '$descricao',
                '$objetivos',
                '$cenario',
                '$justificativa',
                '$estrategia',
                '$qtd_pessoas',
                '$id_status',
                '$iteracoes',
                '$envolvidos',
                '$orcamento',
                '$obs'
            )";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: proj2_cad.php?m=1");
    }else{
        header("Location: proj2_cad.php?m=2");
    }

?>