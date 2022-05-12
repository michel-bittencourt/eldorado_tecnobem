<?php
include('includes/ini_painel.php');

titulo_pagina("Distribuir Produção");

if (isset($_GET['m'])) {
    $m = $_GET['m'];
    if ($m == '1') {
        echo "<div class='alert alert-success' role='alert'>Registro gravado com sucesso!</div>";
    }else if ($m == '2') {
        echo "<div class='alert alert-danger' role='alert'>Registro não gravou!</div>";
    }
}

?>

<div class="row col-sm-12">
    
    <form method="post" action="producao_gra.php" name="form1" id="form1" class="col-sm-12">
        
        <div class="form-group row">

            <label for="id_campanha" class="col-sm-2 col-form-label text-right">Operadores</label>
            <div class="col-sm-10">
                <select class="form-control" id="id_campanha" name="id_campanha" required>
                    <option></option>
                    <?php
                    $sql_serv = "SELECT A.id_campanha, A.data_ini, A.data_fim, B.servico FROM campanha A, servicos B WHERE A.ativo = 's' AND A.id_servico = B.id_servico ORDER BY B.servico";
                    $query_serv = $conn->query($sql_serv);
                    while ($row_serv = $query_serv->fetch_array()) {
                        echo "<option value='".$row_serv['id_campanha']."'>".$row_serv['servico']." | de ".date("d/m/Y",strtotime($row_serv['data_ini']))." à ".date("d/m/Y",strtotime($row_serv['data_fim']))."</option>";
                    };
                    ?>
                </select>
            </div>
		</div>

        <div class="form-group row">
            <label for="id_cidade" class="col-sm-2 col-form-label text-right">Cidade</label>
            <div class="col-sm-10">
                <select class="form-control" id="sel_cidade" name="id_cidade" required>
                    <option></option>
                    <?php
                    $sql_cidade = "SELECT * FROM cidades WHERE ativo = 's' ORDER BY cidade";
                    $query_cidade = $conn->query($sql_cidade);
                    while ($row_cidade = $query_cidade->fetch_array()) {
                        echo "<option value='".$row_cidade['id_cidade']."'>".$row_cidade['cidade']."</option>";
                    };
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="id_grupo" class="col-sm-2 col-form-label text-right">Grupo</label>
            <div class="col-sm-10" id="div_grupo">
                <select class="form-control" id="id_grupo" name="id_grupo" required>
                    <option></option>
                    <?php
                    $sql_grupo = "SELECT * FROM grupos WHERE ativo = 's' ORDER BY grupo";
                    $query_grupo = $conn->query($sql_grupo);
                    while ($row_grupo = $query_grupo->fetch_array()) {
                        echo "<option value='".$row_grupo['id_grupo']."'>".$row_grupo['grupo']."</option>";
                    };
                    ?>
                </select>
            </div>
        </div>


        <div class="form-group row">
            <label for="id_colab" class="col-sm-2 col-form-label text-right">Atendente</label>
            <div class="col-sm-10">
                <select class="form-control" id="id_colab" name="id_colab" required>
                    <option></option>
                    <?php
                    $sql_atendente = "SELECT * FROM usuarios WHERE ativo = 's' AND tipo = '4' ORDER BY user";
                    $query_atendente = $conn->query($sql_atendente);
                    while ($row_atendente = $query_atendente->fetch_array()) {
                        echo "<option value='".$row_atendente['id_user']."'>".$row_atendente['user']."</option>";
                    };
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="qtd" class="col-sm-2 col-form-label text-right">Quantidade (1-5000)</label>
            <div class="col-sm-10">
                <input type="number" step="1" min="1" max="5000" class="form-control" id="qtd" name="qtd" required>
            </div>
        </div>

        <div class="form-group col-md-12 text-center">
            <button type="submit" class="btn btn-success">Gravar</button>
            <a href="painel.php" class="btn btn-primary">Voltar para o início</a>
        </div>		
		
	</form>


    <!-- DataTables Example -->
    <div class="card mb-3 container-fluid">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Produção
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Campanha</th>
                        <th>Cidade</th>
                        <th>Grupo</th>
                        <th>Atendente</th>
                        <th>Qtd</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Campanha</th>
                        <th>Cidade</th>
                        <th>Grupo</th>
                        <th>Atendente</th>
                        <th>Qtd</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $sql = "SELECT A.id_producao, A.qtd, B.data_ini, B.data_fim, C.servico, D.cidade, E.grupo, F.user
                            FROM producao A, campanha B, servicos C, cidades D, grupos E, usuarios F
                            WHERE A.ativo = 's'
                            AND A.id_campanha = B.id_campanha
                            AND B.id_servico = C.id_servico
                            AND A.id_cidade = D.id_cidade
                            AND A.id_grupo = E.id_grupo
                            AND A.id_colab = F.id_user
                        ";

                        //echo $sql;


                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr style="background-color: <?=$cor?>">
                            <td class="text-center"><?=$row['id_producao']?></td>
                            <td class="text-center"><?=$row['servico']?> | de <?=date("d/m/Y",strtotime($row['data_ini']))?> à <?=date("d/m/Y",strtotime($row['data_fim']))?></td>
                            <td class="text-center"><?=$row['cidade']?></td>
                            <td class="text-center"><?=$row['grupo']?></td>
                            <td class="text-center"><?=$row['user']?></td>
                            <td class="text-center"><?=$row['qtd']?></td>
                            <td style="width: 150px">
                                <button class="btn btn-warning" onclick="location.href='producao_edi.php?id=<?=$row['id_producao']?>'">Editar</button>

                                <a class="btn btn-danger" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='producao_del.php?id=<?=$row['id_producao']?>'}">Excluir</a>    
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Atualizado hoje às <?=date('H:m')?></div>
    </div>

<?php
include('includes/fim_painel.php');
?>