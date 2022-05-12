<?php
include ("includes/ini_print.php");

if(isset($_POST['projeto']) && $_POST['projeto'] != ""){
    $var_projeto = " AND A.projeto LIKE '%".$_POST['projeto']."%'";
}else{
    $var_projeto = "";
}

if(isset($_POST['id_secretaria']) && $_POST['id_secretaria'] != ""){
    $var_secretaria = " AND A.id_secretaria = ".$_POST['id_secretaria'];
}else{
    $var_secretaria = "";
}

if(isset($_POST['inicio']) && $_POST['inicio'] != ""){
    $hoje = date("Y-m-d");
    $data_ini     = $_POST['inicio'];
    if(isset($_POST['fim']) && $_POST['fim'] != ""){
        $data_fim = $_POST['fim'];
    }else{
        $data_fim = $hoje;
    }   
    $var_data = " AND A.inicio BETWEEN '".$data_ini."' AND '".$data_fim."'";
}else{
    $var_data = "";
}

if(isset($_POST['gestor']) && $_POST['gestor'] != ""){
    $var_gestor = " AND A.gestor LIKE '%".$_POST['gestor']."%'";
}else{
    $var_gestor  = "";
}


if(isset($_POST['responsavel']) && $_POST['responsavel'] != ""){
    $var_responsavel = " AND A.responsavel LIKE '%".$_POST['responsavel']."%'";
}else{
    $var_responsavel  = "";
}


if(isset($_POST['descricao']) && $_POST['descricao'] != ""){
    $var_descricao = " AND A.descricao LIKE '%".$_POST['descricao']."%'";
}else{
    $var_descricao  = "";
}


if(isset($_POST['objetivos']) && $_POST['objetivos'] != ""){
    $var_objetivos = " AND A.objetivos LIKE '%".$_POST['objetivos']."%'";
}else{
    $var_objetivos  = "";
}


if(isset($_POST['justificativa']) && $_POST['justificativa'] != ""){
    $var_justificativa = " AND A.justificativa LIKE '%".$_POST['justificativa']."%'";
}else{
    $var_justificativa  = "";
}


if(isset($_POST['estrategia']) && $_POST['estrategia'] != ""){
    $var_estrategia = " AND A.estrategia LIKE '%".$_POST['estrategia']."%'";
}else{
    $var_estrategia  = "";
}


if(isset($_POST['qtd_pessoas']) && $_POST['qtd_pessoas'] != ""){
    $var_qtd_pessoas = " AND A.qtd_pessoas LIKE '%".$_POST['qtd_pessoas']."%'";
}else{
    $var_qtd_pessoas  = "";
}


if(isset($_POST['status']) && $_POST['status'] != ""){
    $var_status = " AND A.status = '".$_POST['status']."'";
}else{
    $var_status  = "";
}


if(isset($_POST['iteracoes']) && $_POST['iteracoes'] != ""){
    $var_iteracoes = " AND A.iteracoes LIKE '%".$_POST['iteracoes']."%'";
}else{
    $var_iteracoes  = "";
}


if(isset($_POST['envolvidos']) && $_POST['envolvidos'] != ""){
    $var_envolvidos = " AND A.envolvidos LIKE '%".$_POST['envolvidos']."%'";
}else{
    $var_envolvidos  = "";
}


if(isset($_POST['orcamento']) && $_POST['orcamento'] != ""){
    $var_orcamento = " AND A.orcamento LIKE '%".$_POST['orcamento']."%'";
}else{
    $var_orcamento = "";
}


if(isset($_POST['obs']) && $_POST['obs'] != ""){
    $var_obs = " AND A.obs LIKE '%".$_POST['obs']."%'";
}else{
    $var_obs  = "";
}

?>


<div class="card mb-3 container-fluid">
    <div class="card-header">
        <h3>Cadastro de Projetos</h3>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Projeto</th>
                        <th>Secretaria</th>
                        <th>Gestor</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Projeto</th>
                        <th>Secretaria</th>
                        <th>Gestor</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $sql = "SELECT A.id_projeto, A.projeto, A.gestor, B.sigla, C.status
                        FROM projetos2 A, secretarias B, status C
                        WHERE A.ativo = 's'
                        AND A.id_secretaria = B.id_secretaria
                        AND A.id_status = C.id_status                        
                        $var_projeto
                        $var_secretaria
                        $var_inicio
                        $var_fim
                        $var_gestor
                        $var_responsavel
                        $var_descricao
                        $var_objetivos
                        $var_cenario
                        $var_justificativa
                        $var_estrategia
                        $var_qtd_pessoas
                        $var_id_status
                        $var_iteracoes
                        $var_envolvidos
                        $var_orcamento
                        $var_obs
                        ORDER BY A.projeto
                    ";

                    //echo $sql;

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr>
                            <td class="text-center"><?=$row['id_projeto']?></td>
                            <td class="text-center"><?=$row['projeto']?></td>
                            <td class="text-center"><?=$row['sigla']?></td>
                            <td class="text-center"><?=$row['gestor']?></td>
                            <td class="text-center"><?=$row['status']?></td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Atualizado hoje às <?=date('H:m')?></div>
</div> 

<?php
include ("includes/fim.php");
?>