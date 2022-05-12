<?php
include ("includes/ini.php");
?>

<div class="row divisor_titulo" style="">
    <label class="col-sm-12"><h3>Cadastro de Projetos</h3></label>
</div>

<?php
if (isset($_GET['m'])) {
    $m = $_GET['m'];
    if ($m == '1') {
        echo "<div class='alert alert-success' role='alert'>Registro gravado com sucesso!</div>";
    }else if ($m == '2') {
        echo "<div class='alert alert-danger' role='alert'>Registro não gravou!</div>";
    }else if ($m == '3') {
        echo "<div class='alert alert-danger' role='alert'>Registro excluído com sucesso!</div>";
    }
}

?>

<form action="proj2_gra.php" method="post">

    <div class="form-group row">
        <label for="projeto" class="col-sm-2 col-form-label text-right"><b>Nome do Projeto</b></label>
        <div class="col-sm-8">
           <input type="text" name="projeto" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="secretaria" class="col-sm-2 col-form-label text-right"><b>Secretaria</b></label>
        <div class="col-sm-8">
           <select class="form-control" name="id_secretaria" required="required">
               <option value=""></option>
               <?php
               $sql_secret = "SELECT * FROM secretarias WHERE ativo = 's' ORDER BY secretaria";
               $result_secret = $conn->query($sql_secret);
               while($row_secret = $result_secret->fetch_assoc()){
               ?>   
               <option value="<?=$row_secret['id_secretaria']?>"><?=$row_secret['secretaria']?></option>
               <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="inicio" class="col-sm-2 col-form-label text-right"><b>Início</b></label>
        <div class="col-sm-8">
           <input type="date" name="inicio" class="form-control" required="required">
        </div>
    </div>    

    <div class="form-group row">
        <label for="fim" class="col-sm-2 col-form-label text-right"><b>Fim</b></label>
        <div class="col-sm-8">
           <input type="date" name="fim" class="form-control" required="required">
        </div>
    </div>   

    <div class="form-group row">
        <label for="gestor" class="col-sm-2 col-form-label text-right"><b>Gestor</b></label>
        <div class="col-sm-8">
            <input type="text" name="gestor" class="form-control" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="responsavel" class="col-sm-2 col-form-label text-right"><b>Responsável</b></label>
        <div class="col-sm-8">
            <input type="text" name="responsavel" class="form-control" required="required">
        </div>
    </div>         

    <div class="form-group row">
        <label for="descricao" class="col-sm-2 col-form-label text-right"><b>Descrição</b></label>
        <div class="col-sm-8">
            <textarea name="descricao" class="form-control"></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="descricao" class="col-sm-2 col-form-label text-right"><b>Objetivos Específicos</b></label>
        <div class="col-sm-8">
            <textarea name="objetivos" class="form-control"></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="cenario" class="col-sm-2 col-form-label text-right"><b>Cenário Atual</b></label>
        <div class="col-sm-8">
            <textarea name="cenario" class="form-control"></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="justificativa" class="col-sm-2 col-form-label text-right"><b>Justificativa</b></label>
        <div class="col-sm-8">
            <textarea name="justificativa" class="form-control"></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="estrategia" class="col-sm-2 col-form-label text-right"><b>Estratégia</b></label>
        <div class="col-sm-8">
            <textarea name="estrategia" class="form-control"></textarea>
        </div>
    </div>  

    <div class="form-group row">
        <label for="qtd_pessoas" class="col-sm-2 col-form-label text-right"><b>Pessoas Beneficiadas</b></label>
        <div class="col-sm-8">
           <input type="number" name="qtd_pessoas" class="form-control">
        </div>
    </div>  

    <div class="form-group row">
        <label for="id_status" class="col-sm-2 col-form-label text-right"><b>Situação</b></label>
        <div class="col-sm-8">
           <select class="form-control" name="id_status" required="required">
               <?php
               $sql_status = "SELECT * FROM status WHERE ativo = 's' ORDER BY id_status";
               $result_status = $conn->query($sql_status);
               while($row_status = $result_status->fetch_assoc()){
               ?>   
               <option value="<?=$row_status['id_status']?>"><?=$row_status['status']?></option>
               <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="iteracoes" class="col-sm-2 col-form-label text-right">
            <b>Iterações</b><br>
            Informar responsável, descrição da tarefa e data prevista para final
        </label>
        <div class="col-sm-8">
            <textarea name="iteracoes" class="form-control"></textarea>
        </div>
    </div>      

    <div class="form-group row">
        <label for="envolvidos" class="col-sm-2 col-form-label text-right">
            <b>Pessoas Envolvidas</b><br>
            Informar nome, secretaria, tarefa e data prevista para finalizar
        </label>
        <div class="col-sm-8">
            <textarea name="envolvidos" class="form-control"></textarea>
        </div>
    </div>      

    <div class="form-group row">
        <label for="orcamento" class="col-sm-2 col-form-label text-right">
            <b>Orçamento</b><br>
            Informar descrição, periodicidade (mensal ou anual), destino e valor previsto
        </label>
        <div class="col-sm-8">
            <textarea name="orcamento" class="form-control"></textarea>
        </div>
    </div>      

    <div class="form-group row">
        <label for="obs" class="col-sm-2 col-form-label text-right"><b>Observações</b></label>
        <div class="col-sm-8">
            <textarea name="obs" class="form-control"></textarea>
        </div>
    </div>  


    <div class="form-group row">
        <input type="submit" class="btn btn-success" value="Gravar">
    </div>
</form>

<div class="card mb-3 container-fluid">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Cadastro de Projetos
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Projeto</th>
                        <th>Secretaria</th>
                        <th>Gestor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Projeto</th>
                        <th>Secretaria</th>
                        <th>Gestor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    
                    if($adm != 's'){
                        $secret = " AND A.id_secretaria = $id_sec ";
                    }else{
                        $secret = "";
                    }                    

                    $sql = "SELECT A.id_projeto, A.projeto, A.gestor, B.sigla, C.status
                            FROM projetos2 A, secretarias B, status C
                            WHERE A.ativo = 's'
                            AND A.id_secretaria = B.id_secretaria
                            AND A.id_status = C.id_status
                            $secret
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
                            <td style="width: 200px">
                                <a class="btn btn-primary" href="proj2_edi.php?id=<?=$row['id_projeto']?>">Editar</a>

                                <a class="btn btn-danger" href="javascript:if(confirm('Tem certeza que deseja excluir este registro?')){location.href='proj2_del.php?id=<?=$row['id_projeto']?>'}">Excluir</a>    
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
include ("includes/fim.php");
?>