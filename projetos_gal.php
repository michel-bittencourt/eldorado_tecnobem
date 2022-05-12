<?php
include('includes/db.php');

$id             = $_POST['id'];
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

$sql = "UPDATE projetos2 SET 
                projeto             = '$projeto',
                id_secretaria       = '$id_secretaria',
                inicio              = '$inicio',
                fim                 = '$fim',
                gestor              = '$gestor',
                responsavel         = '$responsavel',
                descricao           = '$descricao',
                objetivos           = '$objetivos',
                cenario             = '$cenario',
                justificativa       = '$justificativa',
                estrategia          = '$estrategia',
                qtd_pessoas         = '$qtd_pessoas',
                id_status           = '$id_status',
                iteracoes           = '$iteracoes',
                envolvidos          = '$envolvidos',
                orcamento           = '$orcamento',
                obs                 = '$obs'
        WHERE id_projeto = $id ";


    $resultado = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) != 0){
        header("Location: proj2_edi.php?m=1&id=".$id);
    }else{
        header("Location: proj2_edi.php?m=2&id=".$id);
    }

?>